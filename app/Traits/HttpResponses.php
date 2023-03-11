<?php

namespace App\Traits;

trait HttpResponses {
    protected function success($data = null, $message = null, int $code = 200): \Illuminate\Http\JsonResponse
    {
        $res = [
            'status' => __('general.success')
        ];
        isset($message) && ($res['message'] = $message);
        isset($data) && ($res['data'] = $data);

        return response()->json($res, $code);
    }

    protected function error($data = null, $message = null, $code = 422): \Illuminate\Http\JsonResponse
    {
        $res = [
            'status' => __('general.failed'),
            'message' => $message,
            'data' => $data
        ];

        if(is_null($message)) {
            unset($res['message']);
        }
        if(is_null($data)) {
            unset($res['data']);
        }

        return response()->json($res, $code);
    }
}
