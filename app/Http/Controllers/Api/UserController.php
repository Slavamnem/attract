<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.2019
 * Time: 22:54
 */

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\UserResource;
use App\Services\Interfaces\UserServiceInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * AuthController constructor.
     * @param Request $request
     * @param UserServiceInterface $userService
     */
    public function __construct(Request $request, UserServiceInterface $userService)
    {
        $this->request = $request;
        $this->userService = $userService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers()
    {
        return ResponseHelper::success(UserResource::collection($this->userService->getAllUsersWithoutCurrent()));
    }
}