<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.2019
 * Time: 23:41
 */

namespace App\Services\Interfaces;

use App\Http\Requests\RegistrationRequest;
use App\User;

interface UserServiceInterface
{
    /**
     * @param RegistrationRequest $request
     * @return User
     */
    public function createUser(RegistrationRequest $request) : User;

    /**
     * @param User $user
     * @return array
     */
    public function getUserCredentials(User $user);

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsersWithoutCurrent();

    /**
     * @param User $user
     * @return array
     */
    public function getRefreshedUserAccessTokens(User $user);

    /**
     * @param User $user
     * @return array
     */
    public function getUserAccessTokens(User $user);
}
