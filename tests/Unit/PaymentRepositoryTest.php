<?php

namespace Tests\Unit;

use App\Models\Payment;
use App\Repositories\PaymentRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private PaymentRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new PaymentRepository(new Payment());
    }

    public function test_can_create()
    {
        $data = Payment::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('payments', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = Payment::factory()->create();
        $updated = $this->repository->update(['status' => 'succeeded'], $model->id);

        $this->assertEquals('succeeded', $updated->status);
    }

    public function test_can_delete()
    {
        $model = Payment::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('payments', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = Payment::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
