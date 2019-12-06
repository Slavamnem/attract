<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.12.2019
 * Time: 23:01
 */

namespace App\Strategies\OauthGrantType\Strategies;

use App\Services\Interfaces\UserServiceInterface;
use App\Strategies\Interfaces\OauthGrantTypeStrategyInterface;
use App\User;

class ClientCredentialsGrantTypeStrategy implements OauthGrantTypeStrategyInterface
{
    /**
     * @param User $user
     * @return array|null
     */
    public function getUserTokens(User $user)
    {
        if ($this->isCorrectCredentials($user)) {
            $userService = resolve(UserServiceInterface::class);

            return empty($user->access_token) ? $userService->getRefreshedUserAccessTokens($user) : $userService->getUserAccessTokens($user);
        }

        return [];
    }

    /**
     * @param User $user
     * @return bool
     */
    private function isCorrectCredentials(User $user)
    {
        return $user->id == request()->input('client_id') && $user->client_secret == request()->input('client_secret');
    }
}
