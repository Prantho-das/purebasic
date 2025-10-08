<?php

namespace App\Otp;
use App\Student;


class Otp
{


	public function otp($data)
	{

		$student = Student::where('id',$data)->first();
        $number =$student->mobile;
        $massage = '(PURE BASIC) Your OTP is:'.$student->otp;

		$this->singleSms($number,$massage);


	}

	public function sendMessage($mobile, $message)
    {
        $this->singleSms($mobile,$message);

    }


 private function singleSms($number,$massage) {
	$params = [
        "api_token" => "PUREBASIC-e245d74c-71fa-41b6-91d2-e4dfb175027e",
        "sid" => "PUREBASICNON",
        "msisdn" => $number,
        "sms" => $massage,
        "csms_id" => "2934fe343"
    ];
    $url = trim('https://smsplus.sslwireless.com', '/')."/api/v3/send-sms";
    $params = json_encode($params);

    $this->callApi($url, $params);

}
	function callApi($url, $params){

    $ch = curl_init(); // Initialize cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($params),
        'accept:application/json'
    ));

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}


}
