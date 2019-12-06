<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.12.2019
 * Time: 23:00
 */

namespace App\Strategies\Interfaces;

use App\User;

interface OauthGrantTypeStrategyInterface
{
    /**
     * @param User $user
     * @return array
     */
    public function getUserTokens(User $user);
}
