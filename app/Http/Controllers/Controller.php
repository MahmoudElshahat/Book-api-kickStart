<?php

namespace App\Http\Controllers;

abstract class Controller
{
    
    protected function error_exception($exception,$className)
    {
        $response = [
            'codeStatus' => $exception->getCode(),
            'file' => $className,
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
        ];

        return response()->json($response);
    }

    // *===========================================
    // *===========================================
    protected function error_message(string $message='',int $code=400)
    {
        $response = [
            'codeStatus' => $code,
            'message' => $message,
        ];

        return response()->json($response);
    }
    // *===========================================
    // *===========================================

    protected function success_response( $data = [],string $message = 'ok', int $code = 200)
    {
        $response = [
            'codeStatus' => $code,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }
}
