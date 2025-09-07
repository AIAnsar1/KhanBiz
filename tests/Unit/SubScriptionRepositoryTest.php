<?php

namespace Tests\Unit;

use App\Models\SubScription;
use App\Repositories\SubScriptionRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubScriptionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private SubScriptionRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new SubScriptionRepository(new SubScription());
    }

    public function test_can_create()
    {
        $data = SubScription::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('sub_scriptions', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = SubScription::factory()->create();
        $updated = $this->repository->update(['status' => 'active'], $model->id);

        $this->assertEquals('active', $updated->status);
    }

    public function test_can_delete()
    {
        $model = SubScription::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('sub_scriptions', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = SubScription::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
