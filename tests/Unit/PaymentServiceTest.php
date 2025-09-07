<?php

namespace Tests\Unit;

use App\Models\Payment;
use App\Services\PaymentService;
use App\Repositories\PaymentRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentServiceTest extends TestCase
{
    use RefreshDatabase;

    private PaymentService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new PaymentRepository(new Payment());
        $this->service = new PaymentService($repo);
    }

    public function test_create_model()
    {
        $data = Payment::factory()->make()->toArray();
        $model = $this->service->createModel($data);
        $this->assertDatabaseHas('payments', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = Payment::factory()->create();
        $updated = $this->service->updateModel(['status' => 'succeeded'], $model->id);

        $this->assertEquals('succeeded', $updated->status);
    }

    public function test_delete_model()
    {
        $model = Payment::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('payments', ['id' => $model->id]);
    }

}