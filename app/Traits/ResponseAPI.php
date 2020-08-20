<?php 

namespace App\Traits;

trait ResponseAPI
{
    public function response($message, $data = null, $statusCode = 200)
    {
        if(!$message){
            return response()->json(['message' => 'Message is required'], 500);
        }

        if($statusCode >= 200 && $statusCode < 300){
            return response()->json([
                'message' => $message,
                'error' => false,
                'code' => $statusCode,
                'results' => $data,
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode,
            ], $statusCode);
        }
    }
}

