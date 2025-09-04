<?php

namespace App\Http\Controllers;

use App\Http\Resources\TendersResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Tenders;
use App\Services\TendersService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreTendersRequest;
use App\Http\Requests\UpdateRequest\UpdateTendersRequest;


class TendersController extends Controller
{
    /**
     * @var TendersService
     */
    private TendersService $service;

    /**
     * @param TendersService $service
     */
    public function __construct(TendersService $service)
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
        return TendersResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreTendersRequest $request
     * @return array|Builder|Collection|Tenders
     * @throws Throwable
     */
    public function store(StoreTendersRequest $request): array |Builder|Collection|Tenders
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $tenders_id
     * @return TendersResource
     * @throws Throwable
     */
    public function show(int $tenders_id)
    {
        return new TendersResource( $this->service->getModelById( $tenders_id ));
    }

    /**
     * @param UpdateTendersRequest $request
     * @param int $tenders_id
     * @return array|Tenders|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateTendersRequest $request, int $tenders_id): array |Tenders|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $tenders_id);

    }

    /**
     * @param int $tenders_id
     * @return array|Builder|Collection|Tenders
     * @throws Throwable
     */
    public function destroy(int $tenders_id): array |Builder|Collection|Tenders
    {
        return $this->service->deleteModel($tenders_id);
    }
}

