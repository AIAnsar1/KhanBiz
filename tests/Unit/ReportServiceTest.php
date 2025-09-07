<?php

namespace Tests\Unit;

use App\Models\Report;
use App\Services\ReportService;
use App\Repositories\ReportRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportServiceTest extends TestCase
{
    use RefreshDatabase;

    private ReportService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new ReportRepository(new Report());
        $this->service = new ReportService($repo);
    }

    public function test_create_model()
    {
        $data = Report::factory()->make()->toArray();
        $model = $this->service->createModel($data);

        $this->assertDatabaseHas('reports', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = Report::factory()->create();
        $updated = $this->service->updateModel(['reason' => 'New Service'], $model->id);

        $this->assertEquals('New Service', $updated->reason);
    }

    public function test_delete_model()
    {
        $model = Report::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('reports', ['id' => $model->id]);
    }

}