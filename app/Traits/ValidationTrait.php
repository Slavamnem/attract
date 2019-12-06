<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.12.2019
 * Time: 21:56
 */

namespace App\Traits;

use App\Http\Requests\ApiRequest;
use Illuminate\Support\Facades\Validator;

trait ValidationTrait
{
    /**
     * @param ApiRequest $request
     * @return bool
     */
    public function isFailed(ApiRequest $request)
    {
        return Validator::make($request->all(), $request->apiRules())->fails();
    }

    /**
     * @param ApiRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResponseWithErrors(ApiRequest $request)
    {
        return response()->json(Validator::make($request->all(), $request->apiRules(), $request->messages())->errors())->setStatusCode(400);
    }
}