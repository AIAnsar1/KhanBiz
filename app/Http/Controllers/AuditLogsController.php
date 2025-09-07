<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuditLogsResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\AuditLogs;
use App\Services\AuditLogsService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreAuditLogsRequest;
use App\Http\Requests\UpdateRequest\UpdateAuditLogsRequest;


class AuditLogsController extends Controller
{
    /**
     * @var AuditLogsService
     */
    private AuditLogsService $service;

    /**
     * @param AuditLogsService $service
     */
    public function __construct(AuditLogsService $service)
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
        return AuditLogsResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreAuditLogsRequest $request
     * @return array|Builder|Collection|AuditLogs
     * @throws Throwable
     */
    public function store(StoreAuditLogsRequest $request): array |Builder|Collection|AuditLogs
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $auditlogs_id
     * @return AuditLogsResource
     * @throws Throwable
     */
    public function show(int $auditlogs_id)
    {
        return new AuditLogsResource( $this->service->getModelById( $auditlogs_id ));
    }

    /**
     * @param UpdateAuditLogsRequest $request
     * @param int $auditlogs_id
     * @return array|AuditLogs|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateAuditLogsRequest $request, int $auditlogs_id): array |AuditLogs|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $auditlogs_id);

    }

    /**
     * @param int $auditlogs_id
     * @return array|Builder|Collection|AuditLogs
     * @throws Throwable
     */
    public function destroy(int $auditlogs_id): array |Builder|Collection|AuditLogs
    {
        return $this->service->deleteModel($auditlogs_id);
    }
}

