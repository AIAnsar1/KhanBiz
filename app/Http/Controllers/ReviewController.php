<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreReviewRequest;
use App\Http\Requests\UpdateRequest\UpdateReviewRequest;


class ReviewController extends Controller
{
    /**
     * @var ReviewService
     */
    private ReviewService $service;

    /**
     * @param ReviewService $service
     */
    public function __construct(ReviewService $service)
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
        return ReviewResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreReviewRequest $request
     * @return array|Builder|Collection|Review
     * @throws Throwable
     */
    public function store(StoreReviewRequest $request): array |Builder|Collection|Review
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $review_id
     * @return ReviewResource
     * @throws Throwable
     */
    public function show(int $review_id)
    {
        return new ReviewResource( $this->service->getModelById( $review_id ));
    }

    /**
     * @param UpdateReviewRequest $request
     * @param int $review_id
     * @return array|Review|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateReviewRequest $request, int $review_id): array |Review|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $review_id);

    }

    /**
     * @param int $review_id
     * @return array|Builder|Collection|Review
     * @throws Throwable
     */
    public function destroy(int $review_id): array |Builder|Collection|Review
    {
        return $this->service->deleteModel($review_id);
    }
}

