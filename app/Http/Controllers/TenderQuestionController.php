<?php

namespace App\Http\Controllers;

use App\Http\Resources\TenderQuestionResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\TenderQuestion;
use App\Services\TenderQuestionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreTenderQuestionRequest;
use App\Http\Requests\UpdateRequest\UpdateTenderQuestionRequest;


class TenderQuestionController extends Controller
{
    /**
     * @var TenderQuestionService
     */
    private TenderQuestionService $service;

    /**
     * @param TenderQuestionService $service
     */
    public function __construct(TenderQuestionService $service)
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
        return TenderQuestionResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreTenderQuestionRequest $request
     * @return array|Builder|Collection|TenderQuestion
     * @throws Throwable
     */
    public function store(StoreTenderQuestionRequest $request): array |Builder|Collection|TenderQuestion
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $tenderquestion_id
     * @return TenderQuestionResource
     * @throws Throwable
     */
    public function show(int $tenderquestion_id)
    {
        return new TenderQuestionResource( $this->service->getModelById( $tenderquestion_id ));
    }

    /**
     * @param UpdateTenderQuestionRequest $request
     * @param int $tenderquestion_id
     * @return array|TenderQuestion|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateTenderQuestionRequest $request, int $tenderquestion_id): array |TenderQuestion|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $tenderquestion_id);

    }

    /**
     * @param int $tenderquestion_id
     * @return array|Builder|Collection|TenderQuestion
     * @throws Throwable
     */
    public function destroy(int $tenderquestion_id): array |Builder|Collection|TenderQuestion
    {
        return $this->service->deleteModel($tenderquestion_id);
    }
}

