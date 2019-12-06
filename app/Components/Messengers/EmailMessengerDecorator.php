<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.12.2019
 * Time: 0:47
 */

namespace App\Components\Messengers;

use App\Components\EmailDrivers\EmailDriverInterface;
use App\Components\Interfaces\MessengerInterface;
use App\Http\Requests\CreateMessageRequest;
use App\Objects\SendEmailsRequestObject;

class EmailMessengerDecorator extends AbstractMessengerDecorator implements MessengerInterface
{
    /**
     * @param CreateMessageRequest $request
     */
    public function sendMessage(CreateMessageRequest $request)
    {
        resolve(EmailDriverInterface::class)->send((new SendEmailsRequestObject())
            ->addReceiver($request->getReceiver()->getEmail())
            ->setSubject("Сообщение от {$request->getSender()->getLogin()}")
            ->setMessage($request->getMessage())
            ->setTemplate("default")
        );

        $this->messenger->sendMessage($request);
    }
}
