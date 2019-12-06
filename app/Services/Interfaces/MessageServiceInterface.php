<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.2019
 * Time: 23:41
 */

namespace App\Services\Interfaces;

use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\GetMessagesFromUserRequest;
use Illuminate\Support\Collection;

interface MessageServiceInterface
{
    /**
     * @param CreateMessageRequest $request
     * @return string
     */
    public function createMessage(CreateMessageRequest $request) : string;

    /**
     * @param GetMessagesFromUserRequest $request
     * @return Collection
     */
    public function getMessagesFromUser(GetMessagesFromUserRequest $request) : Collection;
}
