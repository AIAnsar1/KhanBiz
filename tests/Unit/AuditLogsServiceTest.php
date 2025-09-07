<?php

namespace Tests\Unit;

use App\Models\AuditLogs;
use App\Services\AuditLogsService;
use App\Repositories\AuditLogsRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuditLogsServiceTest extends TestCase
{
    use RefreshDatabase;

    private AuditLogsService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new AuditLogsRepository(new AuditLogs());
        $this->service = new AuditLogsService($repo);
    }

    public function test_create_model()
    {
        $data = AuditLogs::factory()->make()->toArray();
        $model = $this->service->createModel($data);

        $this->assertDatabaseHas('audit_logs', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = AuditLogs::factory()->create();
        $updated = $this->service->updateModel(['action' => 'New Service'], $model->id);

        $this->assertEquals('New Service', $updated->action);
    }

    public function test_delete_model()
    {
        $model = AuditLogs::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('audit_logs', ['id' => $model->id]);
    }

}