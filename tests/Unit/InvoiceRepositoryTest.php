<?php

namespace Tests\Unit;

use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private InvoiceRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new InvoiceRepository(new Invoice());
    }

    public function test_can_create()
    {
        $data = Invoice::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('invoices', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = Invoice::factory()->create();
        $updated = $this->repository->update(['status' => 'pending'], $model->id);

        $this->assertEquals('pending', $updated->status);
    }

    public function test_can_delete()
    {
        $model = Invoice::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('invoices', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = Invoice::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
