<?php

namespace App\Traits;

trait ApiTraits
{
    public function responseJson($status = 200, $massage = "Successfully Done", $data)
    {
        return response()->json([
            "success" => true,
            "status" => (string) $status,
            "massage" => $massage,
            "data" => $data
        ], $status);
    }

    public function responseJsonWithoutData($status = 200 , $massage = "Successfully Done")
    {
        return response()->json([
            "success" => true,
            "status" => (string) $status,
            "massage" => $massage,
        ], $status);
    }


    public function responseJsonFailed($status = 404 , $massage = "Fail")
    {
        return response()->json([
            "success" => false,
            "status" => (string) $status,
            "massage" => $massage,
        ]);
    }

    public function returnValidationError($validator){
        return $this->responseJsonFailed('011', $validator->errors());
    }
}
