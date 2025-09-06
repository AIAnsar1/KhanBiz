<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StorePaymentRequest;
use App\Http\Requests\UpdateRequest\UpdatePaymentRequest;


class PaymentController extends Controller
{
    /**
     * @var PaymentService
     */
    private PaymentService $service;

    /**
     * @param PaymentService $service
     */
    public function __construct(PaymentService $service)
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
        return PaymentResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StorePaymentRequest $request
     * @return array|Builder|Collection|Payment
     * @throws Throwable
     */
    public function store(StorePaymentRequest $request): array |Builder|Collection|Payment
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $payment_id
     * @return PaymentResource
     * @throws Throwable
     */
    public function show(int $payment_id)
    {
        return new PaymentResource( $this->service->getModelById( $payment_id ));
    }

    /**
     * @param UpdatePaymentRequest $request
     * @param int $payment_id
     * @return array|Payment|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdatePaymentRequest $request, int $payment_id): array |Payment|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $payment_id);

    }

    /**
     * @param int $payment_id
     * @return array|Builder|Collection|Payment
     * @throws Throwable
     */
    public function destroy(int $payment_id): array |Builder|Collection|Payment
    {
        return $this->service->deleteModel($payment_id);
    }
}

