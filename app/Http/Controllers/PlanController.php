<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Plan;
use App\Services\PlanService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StorePlanRequest;
use App\Http\Requests\UpdateRequest\UpdatePlanRequest;


class PlanController extends Controller
{
    /**
     * @var PlanService
     */
    private PlanService $service;

    /**
     * @param PlanService $service
     */
    public function __construct(PlanService $service)
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
        return PlanResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StorePlanRequest $request
     * @return array|Builder|Collection|Plan
     * @throws Throwable
     */
    public function store(StorePlanRequest $request): array |Builder|Collection|Plan
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $plan_id
     * @return PlanResource
     * @throws Throwable
     */
    public function show(int $plan_id)
    {
        return new PlanResource( $this->service->getModelById( $plan_id ));
    }

    /**
     * @param UpdatePlanRequest $request
     * @param int $plan_id
     * @return array|Plan|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdatePlanRequest $request, int $plan_id): array |Plan|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $plan_id);

    }

    /**
     * @param int $plan_id
     * @return array|Builder|Collection|Plan
     * @throws Throwable
     */
    public function destroy(int $plan_id): array |Builder|Collection|Plan
    {
        return $this->service->deleteModel($plan_id);
    }
}

