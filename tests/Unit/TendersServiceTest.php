<?php

namespace Tests\Unit;

use App\Models\Tenders;
use App\Services\TendersService;
use App\Repositories\TendersRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TendersServiceTest extends TestCase
{
    use RefreshDatabase;

    private TendersService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new TendersRepository(new Tenders());
        $this->service = new TendersService($repo);
    }

    public function test_create_model()
    {
        $data = Tenders::factory()->make()->toArray();
        $model = $this->service->createModel($data);
        $this->assertDatabaseHas('tenders', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = Tenders::factory()->create();
        $updated = $this->service->updateModel(['title' => 'title'], $model->id);
        $this->assertEquals('title', $updated->title);
    }

    public function test_delete_model()
    {
        $model = Tenders::factory()->create();
        $this->service->deleteModel($model->id);
        $this->assertDatabaseMissing('tenders', ['id' => $model->id]);
    }

}