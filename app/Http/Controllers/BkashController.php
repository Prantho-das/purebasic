<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use URL;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class BkashController extends Controller
{
    private $base_url;
    private $username;
    private $password;
    private $app_key;
    private $app_secret;

    public function __construct()
    {
        env('SANDBOX') ? $this->base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta' : $this->base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta';
        $this->username = env('BKASH_USERNAME');
        $this->password  = env('BKASH_PASSWORD');
        $this->app_key = env('BKASH_APP_KEY');
        $this->app_secret  = env('BKASH_APP_SECRET');
    }

    public function authHeaders(){
        return array(
            'Content-Type:application/json',
            'Authorization:' .$this->grant(),
            'X-APP-Key:'. $this->app_key 
        );
    }
         
    public function curlWithBody($url,$header,$method,$body_data){
        $curl = curl_init($this->base_url.$url);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $body_data);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function grant()
    {
        $header = array(
                'Content-Type:application/json',
                'username:'.$this->username,
                'password:'.$this->password
                );

        $body_data = array('app_key'=> $this->app_key, 'app_secret'=> $this->app_secret);
    
        $response = $this->curlWithBody('/tokenized/checkout/token/grant',$header,'POST',json_encode($body_data));

        $token = json_decode($response)->id_token;

        return $token;
    }

    public function payment(Request $request)
    {
        return view('bkash.pay');
    }

    public function createPayment(Request $request)
    {
        $header =$this->authHeaders();
        $website_url = URL::to("/");
        
        $referenceArray = explode('_', $request->payerReference);
        $studentId = $referenceArray[0];
        
        
        


        $body_data = array(
            'mode' => '0011',
            'payerReference' => $request->payerReference ? $request->payerReference  : '1', // pass oderId or anything 
            'callbackURL' => $website_url.'/bkash-callback',
            'amount' => $referenceArray[3],
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => $request->merchantInvoiceNumber ? $request->merchantInvoiceNumber : "Inv_".Str::random(6)
        );

        $response = $this->curlWithBody('/tokenized/checkout/create',$header,'POST',json_encode($body_data));

        return redirect((json_decode($response)->bkashURL));
    }

    public function executePayment($paymentID)
    {

        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID
        );


        $response = $this->curlWithBody('/tokenized/checkout/execute',$header,'POST',json_encode($body_data));

        $res_array = json_decode($response,true);

        return $response;
    }

    public function queryPayment($paymentID)
    {

        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/status',$header,'POST',json_encode($body_data));
        
        $res_array = json_decode($response,true);

         return $response;
    }

    public function callback(Request $request)
    {
        $allRequest = $request->all();

        if(isset($allRequest['status']) && $allRequest['status'] == 'failure'){
           return redirect('/payment_history/' . session()->get('id'));

        }else if(isset($allRequest['status']) && $allRequest['status'] == 'cancel'){
           return redirect('/payment_history/' . session()->get('id'));
        }else{
            
            $response = $this->executePayment($allRequest['paymentID']);

            $res_array = json_decode($response,true);
            
            if(array_key_exists("message",$res_array)){
                // if execute api failed to response
                sleep(1);
                $response = $this->queryPayment($allRequest['paymentID']);
                $res_array = json_decode($response,true);
            }

            if(array_key_exists("statusCode",$res_array) && $res_array['statusCode'] == '0000' && array_key_exists("transactionStatus",$res_array) && $res_array['transactionStatus'] == 'Completed'){
                
                // insert data after payment is complete

        
                $referenceArray = explode('_', $res_array['payerReference']);
                $studentId = $referenceArray[0];

                


                
                $now = Carbon::now();


                if ($referenceArray[1] == "bdId") {
                    
                    $batch_package = DB::table('batch_duration')->where('bd_id', $referenceArray[2])->first();
               
                    
                    if (isset($batch_package->subscription_end)) {
    
                        $subscriptionEnd = $batch_package->subscription_end; 
                        
                    } else {
    
                        $subscriptionEnd = Carbon::now()->addDays($batch_package->bd_duration); 
                        
                    }
                
                    
                    $batchStudentsUpdate = DB::table('batch_students')->updateOrInsert(['student_id' => $studentId, 'batch_id' => $batch_package->bd_batch_id], ['student_id' => $studentId, 'batch_id' => $batch_package->bd_batch_id, 
                    'fees' => $batch_package->bd_fee, 'payable' => $batch_package->bd_fee, 'paid' => $res_array['amount'], 'enroll_at' => $now->toDateTimeString(), 
                    'subscription_start' => $now->toDateTimeString(), 'subscription_end' => $subscriptionEnd, 'enroll_status' => 1,
                    'status' => 1, 'bd_id' => $batch_package->bd_id,'reference' => $res_array['trxID'], 'created_at' => $now->toDateTimeString(), 'updated_at' => $now->toDateTimeString(), 'created_by' => $studentId,
                    'updated_by' => $studentId]);
                    
                    
                    $batchSubscriptionHistoryUpdate = DB::table('batch_subscription_history')->insert(['student_id' => $studentId, 'reference_id' => $res_array['trxID'], 'batch_id' => $batch_package->bd_batch_id,'paid' => $res_array['amount'], 
                    'created_at' => $now->toDateTimeString(), 'updated_at' => $now->toDateTimeString()]);
                    
                    
                    return redirect('/payment_completed');

        
                } else {
        
                    $caseSubscriptionUpdate = DB::table('videos')->updateOrInsert(['user_id' => $studentId, 'clinical_case_id' => $referenceArray[2]], ['user_id' => $studentId, 'clinical_case_id' => $referenceArray[2],
                    'paid' => $res_array['amount'], 'reference' => $res_array['trxID'], 'status' => 1, 'is_approved' => 1, 'created_at' => $now->toDateTimeString(), 'updated_at' => $now->toDateTimeString()]);
                    
                    
                    $caseSubscriptionHistoryUpdate = DB::table('batch_subscription_history')->insert(['student_id' => $studentId, 'reference_id' => $res_array['trxID'], 'case_id' => $referenceArray[2],'paid' => $res_array['amount'], 
                    'created_at' => $now->toDateTimeString(), 'updated_at' => $now->toDateTimeString()]);            
                
                    return redirect('/student/' . $studentId . '/watch/clinical_case/' . $referenceArray[2]);

                    
                }

                

                


                
            }
    
           return redirect('/payment_history/' . session()->get('id'));

        }

        return redirect('/payment_history/' . session()->get('id'));

    }

    public function getRefund(Request $request)
    {
        return view('bkash.refund');
    }

    public function refundPayment(Request $request)
    {
        $header =$this->authHeaders();

        $body_data = array(
            'paymentID' => $request->paymentID,
            'trxID' => $request->trxID
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/refund',$header,'POST',json_encode($body_data));

        $res_array = json_decode($response,true);

        $message = "Refund Failed !!";

        if(!isset($res_array['refundTrxID'])){
            
            $body_data = array(
                'paymentID' => $request->paymentID,
                'amount' => $request->amount,
                'trxID' => $request->trxID,
                'sku' => 'sku',
                'reason' => 'Quality issue'
            );
    
            $response = $this->curlWithBody('/tokenized/checkout/payment/refund',$header,'POST',json_encode($body_data));
    
            $res_array = json_decode($response,true);

            // your database insert operation    

            $message = "Refund successful !!.Your Refund TrxID : ".$res_array['refundTrxID'];
        }else{
            $message = "Already Refunded !!.Your Refund TrxID : ".$res_array['refundTrxID'];
        }
        
        return view('bkash.refund')->with([
            'response' => $message,
        ]);
    }      
  

}