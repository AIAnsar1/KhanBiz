<?php

namespace Tests\Unit;

use App\Models\Plan;
use App\Services\PlanService;
use App\Repositories\PlanRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlanServiceTest extends TestCase
{
    use RefreshDatabase;

    private PlanService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new PlanRepository(new Plan());
        $this->service = new PlanService($repo);
    }

    public function test_create_model()
    {
        $data = Plan::factory()->make()->toArray();
        $model = $this->service->createModel($data);

        $this->assertDatabaseHas('plans', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = Plan::factory()->create();
        $updated = $this->service->updateModel(['currency' => 'USD'], $model->id);

        $this->assertEquals('USD', $updated->currency);
    }

    public function test_delete_model()
    {
        $model = Plan::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('plans', ['id' => $model->id]);
    }

}