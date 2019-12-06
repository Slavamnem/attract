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

class RefreshGrantTypeStrategy implements OauthGrantTypeStrategyInterface
{
    /**
     * @param User $user
     * @return array|null
     */
    public function getUserTokens(User $user)
    {
        return $this->isCorrectCredentials($user) ? (resolve(UserServiceInterface::class))->getRefreshedUserAccessTokens($user) : [];
    }

    /**
     * @param User $user
     * @return bool
     */
    private function isCorrectCredentials(User $user)
    {
        return $user->refresh_token == request()->input('refresh_token');
    }
}
