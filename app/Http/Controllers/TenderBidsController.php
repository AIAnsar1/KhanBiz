<?php

namespace App\Http\Controllers;

use App\Http\Resources\TenderBidsResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\TenderBids;
use App\Services\TenderBidsService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreTenderBidsRequest;
use App\Http\Requests\UpdateRequest\UpdateTenderBidsRequest;


class TenderBidsController extends Controller
{
    /**
     * @var TenderBidsService
     */
    private TenderBidsService $service;

    /**
     * @param TenderBidsService $service
     */
    public function __construct(TenderBidsService $service)
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
        return TenderBidsResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreTenderBidsRequest $request
     * @return array|Builder|Collection|TenderBids
     * @throws Throwable
     */
    public function store(StoreTenderBidsRequest $request): array |Builder|Collection|TenderBids
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $tenderbids_id
     * @return TenderBidsResource
     * @throws Throwable
     */
    public function show(int $tenderbids_id)
    {
        return new TenderBidsResource( $this->service->getModelById( $tenderbids_id ));
    }

    /**
     * @param UpdateTenderBidsRequest $request
     * @param int $tenderbids_id
     * @return array|TenderBids|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateTenderBidsRequest $request, int $tenderbids_id): array |TenderBids|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $tenderbids_id);

    }

    /**
     * @param int $tenderbids_id
     * @return array|Builder|Collection|TenderBids
     * @throws Throwable
     */
    public function destroy(int $tenderbids_id): array |Builder|Collection|TenderBids
    {
        return $this->service->deleteModel($tenderbids_id);
    }
}

