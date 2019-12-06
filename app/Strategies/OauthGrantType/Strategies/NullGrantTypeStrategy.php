<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.12.2019
 * Time: 23:01
 */

namespace App\Strategies\OauthGrantType\Strategies;

use App\Strategies\Interfaces\OauthGrantTypeStrategyInterface;
use App\User;

class NullGrantTypeStrategy implements OauthGrantTypeStrategyInterface
{
    /**
     * @param User $user
     * @return array
     */
    public function getUserTokens(User $user)
    {
        return [];
    }
}
