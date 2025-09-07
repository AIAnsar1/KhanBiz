<?php

namespace Tests\Unit;

use App\Models\SubScription;
use App\Services\SubScriptionService;
use App\Repositories\SubScriptionRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubScriptionServiceTest extends TestCase
{
    use RefreshDatabase;

    private SubScriptionService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new SubScriptionRepository(new SubScription());
        $this->service = new SubScriptionService($repo);
    }

    public function test_create_model()
    {
        $data = SubScription::factory()->make()->toArray();
        $model = $this->service->createModel($data);

        $this->assertDatabaseHas('sub_scriptions', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = SubScription::factory()->create();
        $updated = $this->service->updateModel(['status' => 'active'], $model->id);

        $this->assertEquals('active', $updated->status);
    }

    public function test_delete_model()
    {
        $model = SubScription::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('sub_scriptions', ['id' => $model->id]);
    }

}