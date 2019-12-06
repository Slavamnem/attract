<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.12.2019
 * Time: 0:42
 */

namespace App\Components\Messengers;

use App\Components\Interfaces\MessengerInterface;
use App\Http\Requests\CreateMessageRequest;
use App\Message;

class DefaultMessenger implements MessengerInterface
{
    /**
     * @param CreateMessageRequest $request
     */
    public function sendMessage(CreateMessageRequest $request)
    {
        $message = new Message();
        $message->sender_id = $request->getSender()->getId();
        $message->receiver_id = $request->getReceiver()->getId();
        $message->message = $request->getMessage();
        $message->save();
    }
}
