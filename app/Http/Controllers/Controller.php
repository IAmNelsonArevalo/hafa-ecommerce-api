<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * This function reformat the response of the api.
     * @param bool $status - status of request.
     * @param array $message - message of the request.
     * @param mixed $data - data obtained on the request.
     * @return JsonResponse
     */
    public function responseApi(bool $status, array $message, mixed $data): JsonResponse
    {
        $type = $message["type"];

        if($type === "success") {
            $message["code"] = 200;
        } else if ($type === "error") {
            $message["code"] = 500;
        } else if ($type === "warning") {
            $message["code"] = 300;
        } else {
            abort(500);
        }

        return response()->json(array(
           "transaction" => array("status" => $status),
           "message" => $message,
           "data" => $data
        ), $message["code"]);
    }
}
