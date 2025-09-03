<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompaniesResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Companies;
use App\Services\CompaniesService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreCompaniesRequest;
use App\Http\Requests\UpdateRequest\UpdateCompaniesRequest;


class CompaniesController extends Controller
{
    /**
     * @var CompaniesService
     */
    private CompaniesService $service;

    /**
     * @param CompaniesService $service
     */
    public function __construct(CompaniesService $service)
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
        return CompaniesResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreCompaniesRequest $request
     * @return array|Builder|Collection|Companies
     * @throws Throwable
     */
    public function store(StoreCompaniesRequest $request): array |Builder|Collection|Companies
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $companies_id
     * @return CompaniesResource
     * @throws Throwable
     */
    public function show(int $companies_id)
    {
        return new CompaniesResource( $this->service->getModelById( $companies_id ));
    }

    /**
     * @param UpdateCompaniesRequest $request
     * @param int $companies_id
     * @return array|Companies|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateCompaniesRequest $request, int $companies_id): array |Companies|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $companies_id);

    }

    /**
     * @param int $companies_id
     * @return array|Builder|Collection|Companies
     * @throws Throwable
     */
    public function destroy(int $companies_id): array |Builder|Collection|Companies
    {
        return $this->service->deleteModel($companies_id);
    }
}

