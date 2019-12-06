<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.12.2019
 * Time: 0:47
 */

namespace App\Components\Messengers;

use App\Components\Interfaces\MessengerInterface;
use App\Http\Requests\CreateMessageRequest;

abstract class AbstractMessengerDecorator implements MessengerInterface
{
    /**
     * @var MessengerInterface
     */
    protected $messenger;

    /**
     * AbstractMessengerDecorator constructor.
     * @param MessengerInterface $messenger
     */
    public function __construct(MessengerInterface $messenger)
    {
        $this->messenger = $messenger;
    }

    /**
     * @param CreateMessageRequest $request
     */
    public function sendMessage(CreateMessageRequest $request)
    {
        $this->messenger->sendMessage($request);
    }
}
