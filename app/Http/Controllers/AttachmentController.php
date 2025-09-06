<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttachmentResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Attachment;
use App\Services\AttachmentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreAttachmentRequest;
use App\Http\Requests\UpdateRequest\UpdateAttachmentRequest;


class AttachmentController extends Controller
{
    /**
     * @var AttachmentService
     */
    private AttachmentService $service;

    /**
     * @param AttachmentService $service
     */
    public function __construct(AttachmentService $service)
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
        return AttachmentResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreAttachmentRequest $request
     * @return array|Builder|Collection|Attachment
     * @throws Throwable
     */
    public function store(StoreAttachmentRequest $request): array |Builder|Collection|Attachment
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $attachment_id
     * @return AttachmentResource
     * @throws Throwable
     */
    public function show(int $attachment_id)
    {
        return new AttachmentResource( $this->service->getModelById( $attachment_id ));
    }

    /**
     * @param UpdateAttachmentRequest $request
     * @param int $attachment_id
     * @return array|Attachment|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateAttachmentRequest $request, int $attachment_id): array |Attachment|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $attachment_id);

    }

    /**
     * @param int $attachment_id
     * @return array|Builder|Collection|Attachment
     * @throws Throwable
     */
    public function destroy(int $attachment_id): array |Builder|Collection|Attachment
    {
        return $this->service->deleteModel($attachment_id);
    }
}

