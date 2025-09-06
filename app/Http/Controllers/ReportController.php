<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreReportRequest;
use App\Http\Requests\UpdateRequest\UpdateReportRequest;


class ReportController extends Controller
{
    /**
     * @var ReportService
     */
    private ReportService $service;

    /**
     * @param ReportService $service
     */
    public function __construct(ReportService $service)
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
        return ReportResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreReportRequest $request
     * @return array|Builder|Collection|Report
     * @throws Throwable
     */
    public function store(StoreReportRequest $request): array |Builder|Collection|Report
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $report_id
     * @return ReportResource
     * @throws Throwable
     */
    public function show(int $report_id)
    {
        return new ReportResource( $this->service->getModelById( $report_id ));
    }

    /**
     * @param UpdateReportRequest $request
     * @param int $report_id
     * @return array|Report|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateReportRequest $request, int $report_id): array |Report|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $report_id);

    }

    /**
     * @param int $report_id
     * @return array|Builder|Collection|Report
     * @throws Throwable
     */
    public function destroy(int $report_id): array |Builder|Collection|Report
    {
        return $this->service->deleteModel($report_id);
    }
}

