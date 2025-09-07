<?php

namespace Tests\Unit;

use App\Models\AuditLogs;
use App\Repositories\AuditLogsRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuditLogsRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private AuditLogsRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new AuditLogsRepository(new AuditLogs());
    }

    public function test_can_create()
    {
        $data = AuditLogs::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('audit_logs', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = AuditLogs::factory()->create();
        $updated = $this->repository->update(['action' => 'Updated'], $model->id);

        $this->assertEquals('Updated', $updated->action);
    }

    public function test_can_delete()
    {
        $model = AuditLogs::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('audit_logs', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = AuditLogs::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
