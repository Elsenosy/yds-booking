<?php

namespace App\Traits;

trait HasApiResponse
{
    /**
     * Api response functions 
     */

    public function sendSuccess($message, $payload=null, $code = 200)
    {
        return $this->resultResponse(true, $message, $payload, $code);
    }

    public function sendError($message, $payload = null, $code=422)
    {
        return $this->resultResponse(false, $message, $payload, $code);
    }

    private function resultResponse($status = false, $message = "", $payload = [], $code)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'payload' => $payload
        ], $code);
    }
}
