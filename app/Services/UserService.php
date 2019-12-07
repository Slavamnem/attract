<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.2019
 * Time: 23:41
 */

namespace App\Services;

use App\Helpers\CarbonHelper;
use App\Http\Requests\RegistrationRequest;
use App\Services\Interfaces\UserServiceInterface;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    /**
     * @param RegistrationRequest $request
     * @return User
     */
    public function createUser(RegistrationRequest $request) : User
    {
        $user = new User();
        $user->username = $request->getUsername();
        $user->email = $request->getEmail();
        $user->password = password_hash($request->getPassword(), PASSWORD_DEFAULT);
        $user->email_confirmed_at = Carbon::now()->toDateTimeString();
        $user->client_secret = $this->getRandomString();
        $user->save();

        return $user;
    }

    /**
     * @param User $User
     * @return array
     */
    public function getUserCredentials(User $User)
    {
        return [
            'client_id'     => $User->id,
            'client_secret' => $User->client_secret,
        ];
    }


    /**
     * @param User $user
     * @return array
     */
    public function getRefreshedUserAccessTokens(User $user)
    {
        $this->refreshUserAccessTokens($user);

        return $this->getUserAccessTokens($user);
    }

    /**
     * @param User $user
     * @return array
     */
    public function getUserAccessTokens(User $user)
    {
        return [
            'access_token'  => $user->access_token,
            'token_type'    => 'Bearer',
            'expires_in'    => CarbonHelper::getTimeLeft(Carbon::now(), $user->access_token_expires_at),
            'refresh_token' => $user->refresh_token,
            'scope'         => 'read',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsersWithoutCurrent()
    {
        return User::query()
            ->where('id', '!=', Auth::id())
            ->get();
    }

    /**
     * @param User $user
     */
    private function refreshUserAccessTokens(User $user)
    {
        $user->access_token = $this->getRandomString();
        $user->access_token_expires_at = Carbon::now()->addHours(8)->toDateTimeString();
        $user->refresh_token = $this->getRandomString();
        $user->save();
    }

    /**
     * @return string
     */
    private function getRandomString() : string
    {
        return md5(uniqid(rand(), true));
    }
}
