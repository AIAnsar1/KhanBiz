<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Message;
use App\Services\MessageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreMessageRequest;
use App\Http\Requests\UpdateRequest\UpdateMessageRequest;


class MessageController extends Controller
{
    /**
     * @var MessageService
     */
    private MessageService $service;

    /**
     * @param MessageService $service
     */
    public function __construct(MessageService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws Throwable
     */
    public function index(Request $request)
    {
        return MessageResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreMessageRequest $request
     * @return array|Builder|Collection|Message
     * @throws Throwable
     */
    public function store(StoreMessageRequest $request): array |Builder|Collection|Message
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $message_id
     * @return MessageResource
     * @throws Throwable
     */
    public function show(int $message_id)
    {
        return new MessageResource( $this->service->getModelById( $message_id ));
    }

    /**
     * @param UpdateMessageRequest $request
     * @param int $message_id
     * @return array|Message|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateMessageRequest $request, int $message_id): array |Message|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $message_id);

    }

    /**
     * @param int $message_id
     * @return array|Builder|Collection|Message
     * @throws Throwable
     */
    public function destroy(int $message_id): array |Builder|Collection|Message
    {
        return $this->service->deleteModel($message_id);
    }
}

