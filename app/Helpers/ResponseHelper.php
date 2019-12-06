<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.2019
 * Time: 23:06
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Lang;

class ResponseHelper
{
    /**
     * @param $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data, $status = 200)
    {
        return response()->json([
            "success" => true,
            "status"  => $status,
            "data"    => $data
        ]);
    }

    /**
     * @param $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function badRequest($message = null, $status = 400)
    {
        return response($message ?? Lang::get('responses.errors.bad-request'))->setStatusCode($status);
    }

    /**
     * @param $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function unauthorized($message = null, $status = 401)
    {
        return response($message ?? Lang::get('responses.errors.unauthorized'))->setStatusCode($status);
    }
}