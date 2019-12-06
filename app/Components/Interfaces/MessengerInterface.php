<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.12.2019
 * Time: 0:43
 */

namespace App\Components\Interfaces;

use App\Http\Requests\CreateMessageRequest;

interface MessengerInterface
{
    /**
     * @param CreateMessageRequest $request
     */
    public function sendMessage(CreateMessageRequest $request);
}
