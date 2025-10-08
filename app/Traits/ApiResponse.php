<?php
namespace App\Traits;

trait ApiResponse{
    /**
     *
     * @param string $message
     * @param array $data
     * @param integer $http_status
     * @param array $headers
     * @return mixed
     */
    public function respondWithSuccess(string $message,$data=[], int $http_status=200,array $headers=[])
    {
        $response = [
            'success' => true,
            'status' => 'success',
            'error_code' => 0,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response,$http_status,$headers);
    }
    /**
     *
     * @param string $message
     * @param string $next
     * @param array $data
     * @param integer $http_status
     * @param array $headers
     * @return mixed
     */
    public function respondWithSuccessNext(string $message,string $next,array $data=[], int $http_status=200,array $headers=[])
    {
        $response = [
            'success' => true,
            'status' => 'success',
            'error_code' => 0,
            'message' => $message,
            'next' => $next,
            'data' => $data,
        ];
        return response()->json($response,$http_status,$headers);
    }
    /**
     * @param string $message
     * @param array $data
     * @param integer $error_code
     * @param integer $http_status
     * @param array $headers
     * @return mixed
     */
    public function respondWithError(string $message,int $error_code=601,array $data=[], int $http_status=200,array $headers=[])
    {
        $response = [
            'success'=>false,
            'status' => 'failed',
            'error_code'=> $error_code,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response,$http_status,$headers);
    }
    /**
     *
     * @param string $message
     * @param integer $error_code
     * @param string $next
     * @param array $data
     * @param integer $http_status
     * @param array $headers
     * @return mixed
     */
    public function respondWithErrorNext(string $message,int $error_code,string $next,array $data=[], int $http_status=200,array $headers=[])
    {
        $response = [
            'success'=>false,
            'status' => 'failed',
            'error_code'=> $error_code,
            'message' => $message,
            'next' => $next,
            'data' => $data,
        ];
        return response()->json($response,$http_status,$headers);
    }
    /**
     *
     * @param array $errors
     * @param integer $error_code
     * @param integer $http_status
     * @param array $headers
     * @return mixed
     */
    public function respondWithValidationError(array $errors,int $error_code=400,int $http_status=200,array $headers=[])
    {
        $errors = array_map(function ($item){
            return reset($item);
        },$errors);
        $response = [
            'success'=>false,
            'status' => 'failed',
            'error_code'=> $error_code,
            'message' => __('Validation failed'),
            'errors' => $errors
        ];
        return response()->json($response,$http_status,$headers);
    }

    /**
     * @param string $message
     * @param integer $error_code
     * @param integer $http_status
     * @param array $headers
     * @return mixed
     */
    public function respondWithInternalError(string $message='',int $error_code=500, int $http_status=500,array $headers=[])
    {
        if(env('APP_DEBUG')==false)
            $message = __('Something went wrong please try again');
        $response = [
            'success'=>false,
            'status' => 'failed',
            'error_code'=> $error_code,
            'message' => $message
        ];
        return response()->json($response,$http_status,$headers);
    }
}
