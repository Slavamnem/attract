<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.2019
 * Time: 22:54
 */

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\GetMessagesFromUserRequest;
use App\Http\Resources\MessageResource;
use App\Services\Interfaces\MessageServiceInterface;
use App\Traits\ValidationTrait;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    use ValidationTrait;

    /**
     * @var Request
     */
    private $request;
    /**
     * @var MessageServiceInterface
     */
    private $messageService;

    /**
     * MessengerController constructor.
     * @param Request $request
     * @param MessageServiceInterface $messageService
     */
    public function __construct(Request $request, MessageServiceInterface $messageService)
    {
        $this->request = $request;
        $this->messageService = $messageService;
    }

    /**
     * @param CreateMessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMessageRequest $request)
    {
        if ($this->isFailed($request)) {
            return $this->getResponseWithErrors($request);
        }

        return ResponseHelper::success($this->messageService->createMessage($request));
    }

    /**
     * @param GetMessagesFromUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessagesFromUser(GetMessagesFromUserRequest $request)
    {
        if ($this->isFailed($request)) {
            return $this->getResponseWithErrors($request);
        }

        return ResponseHelper::success(MessageResource::collection($this->messageService->getMessagesFromUser($request)));
    }
}
