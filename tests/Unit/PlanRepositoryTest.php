<?php

namespace Tests\Unit;

use App\Models\Plan;
use App\Repositories\PlanRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlanRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private PlanRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new PlanRepository(new Plan());
    }

    public function test_can_create()
    {
        $data = Plan::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('plans', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = Plan::factory()->create();
        $updated = $this->repository->update(['currency' => 'USD'], $model->id);

        $this->assertEquals('USD', $updated->currency);
    }

    public function test_can_delete()
    {
        $model = Plan::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('plans', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = Plan::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
