<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function success($data = null, $message = "Success", $code = 200)
    {
        return response()->json([
            "success" => true,
            "message" => $message,
            "data" => $data,
            "errors" => null
        ], $code);
    }

    public function error($errors = [], $message = "Error", $code = 400)
    {
        return response()->json([
            "success" => false,
            "message" => $message,
            "data" => null,
            "errors" => $errors
        ], $code);
    }
}
