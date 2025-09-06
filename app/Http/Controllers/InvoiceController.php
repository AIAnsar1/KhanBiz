<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreInvoiceRequest;
use App\Http\Requests\UpdateRequest\UpdateInvoiceRequest;


class InvoiceController extends Controller
{
    /**
     * @var InvoiceService
     */
    private InvoiceService $service;

    /**
     * @param InvoiceService $service
     */
    public function __construct(InvoiceService $service)
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
        return InvoiceResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreInvoiceRequest $request
     * @return array|Builder|Collection|Invoice
     * @throws Throwable
     */
    public function store(StoreInvoiceRequest $request): array |Builder|Collection|Invoice
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $invoice_id
     * @return InvoiceResource
     * @throws Throwable
     */
    public function show(int $invoice_id)
    {
        return new InvoiceResource( $this->service->getModelById( $invoice_id ));
    }

    /**
     * @param UpdateInvoiceRequest $request
     * @param int $invoice_id
     * @return array|Invoice|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateInvoiceRequest $request, int $invoice_id): array |Invoice|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $invoice_id);

    }

    /**
     * @param int $invoice_id
     * @return array|Builder|Collection|Invoice
     * @throws Throwable
     */
    public function destroy(int $invoice_id): array |Builder|Collection|Invoice
    {
        return $this->service->deleteModel($invoice_id);
    }
}

