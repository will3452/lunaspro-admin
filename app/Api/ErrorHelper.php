<?php
namespace App\Api;

class ErrorHelper
{
    public static function sendError($code = 404, $message = "NOT FOUND")
    {
        return response([
            'type'=>'ERROR',
            'code'=>$code,
            'message'=> strtoupper($message),
        ], $code);
    }
}
