<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubScriptionResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\SubScription;
use App\Services\SubScriptionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreSubScriptionRequest;
use App\Http\Requests\UpdateRequest\UpdateSubScriptionRequest;


class SubScriptionController extends Controller
{
    /**
     * @var SubScriptionService
     */
    private SubScriptionService $service;

    /**
     * @param SubScriptionService $service
     */
    public function __construct(SubScriptionService $service)
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
        return SubScriptionResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreSubScriptionRequest $request
     * @return array|Builder|Collection|SubScription
     * @throws Throwable
     */
    public function store(StoreSubScriptionRequest $request): array |Builder|Collection|SubScription
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $subscription_id
     * @return SubScriptionResource
     * @throws Throwable
     */
    public function show(int $subscription_id)
    {
        return new SubScriptionResource( $this->service->getModelById( $subscription_id ));
    }

    /**
     * @param UpdateSubScriptionRequest $request
     * @param int $subscription_id
     * @return array|SubScription|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateSubScriptionRequest $request, int $subscription_id): array |SubScription|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $subscription_id);

    }

    /**
     * @param int $subscription_id
     * @return array|Builder|Collection|SubScription
     * @throws Throwable
     */
    public function destroy(int $subscription_id): array |Builder|Collection|SubScription
    {
        return $this->service->deleteModel($subscription_id);
    }
}

