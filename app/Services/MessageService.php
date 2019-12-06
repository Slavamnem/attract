<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.2019
 * Time: 23:41
 */

namespace App\Services;

use App\Components\Messengers\DefaultMessenger;
use App\Components\Messengers\EmailMessengerDecorator;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\GetMessagesFromUserRequest;
use App\Message;
use App\Services\Interfaces\MessageServiceInterface;
use Illuminate\Support\Collection;

class MessageService implements MessageServiceInterface
{
    /**
     * @param CreateMessageRequest $request
     * @return string
     */
   public function createMessage(CreateMessageRequest $request) : string
   {
       $messenger = new DefaultMessenger();

       if ($request->withEmail()) {
           $messenger = new EmailMessengerDecorator($messenger);
       }

       $messenger->sendMessage($request);

       return 'Собщение успешно добавлено!';
   }

    /**
     * @param GetMessagesFromUserRequest $request
     * @return Collection
     */
   public function getMessagesFromUser(GetMessagesFromUserRequest $request) : Collection
   {
       return Message::query()
           ->where('receiver_id', $request->getReceiver()->getId())
           ->where('sender_id', $request->getSender()->getId())
           ->orderByDesc('created_at')
           ->get();
   }
}
