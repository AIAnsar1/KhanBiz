<?php

namespace Tests\Unit;

use App\Models\Invoice;
use App\Services\InvoiceService;
use App\Repositories\InvoiceRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceServiceTest extends TestCase
{
    use RefreshDatabase;

    private InvoiceService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new InvoiceRepository(new Invoice());
        $this->service = new InvoiceService($repo);
    }

    public function test_create_model()
    {
        $data = Invoice::factory()->make()->toArray();
        $model = $this->service->createModel($data);

        $this->assertDatabaseHas('invoices', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = Invoice::factory()->create();
        $updated = $this->service->updateModel(['status' => 'pending'], $model->id);

        $this->assertEquals('pending', $updated->status);
    }

    public function test_delete_model()
    {
        $model = Invoice::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('invoices', ['id' => $model->id]);
    }

}