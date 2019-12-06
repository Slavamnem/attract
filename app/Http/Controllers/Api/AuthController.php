<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.2019
 * Time: 22:54
 */

namespace App\Http\Controllers\Api;

use App\Enums\OauthGrantTypesEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\OauthRequest;
use App\Http\Requests\RegistrationRequest;
use App\Services\Interfaces\UserServiceInterface;
use App\Strategies\Interfaces\StrategyInterface;
use App\Strategies\OauthGrantType\OauthGrantTypeStrategy;
use App\Traits\ValidationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ValidationTrait;

    /**
     * @var Request
     */
    private $request;
    /**
     * @var UserServiceInterface
     */
    private $userService;
    /**
     * @var StrategyInterface
     */
    private $oauthGrantTypeStrategy;

    /**
     * AuthController constructor.
     * @param Request $request
     * @param UserServiceInterface $userService
     */
    public function __construct(Request $request, UserServiceInterface $userService)
    {
        $this->request = $request;
        $this->userService = $userService;
        $this->oauthGrantTypeStrategy = new OauthGrantTypeStrategy();
    }

    /**
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationRequest $request)
    {
        if ($this->isFailed($request)) {
            return $this->getResponseWithErrors($request);
        }

        return ResponseHelper::success($this->userService->getUserCredentials($this->userService->createUser($request)));
    }

    /**
     * @param OauthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function oauth(OauthRequest $request)
    {
        if ($this->isFailed($request)) {
            return $this->getResponseWithErrors($request);
        }

        if ($response = $this->oauthGrantTypeStrategy
            ->getStrategy(OauthGrantTypesEnum::CREATE($this->request->input('grand_type'))->getValue())
            ->getUserTokens(Auth::user())) {

            return ResponseHelper::success($response);
        }

        return ResponseHelper::badRequest();
    }
}
