<?php

namespace Tests\Unit;

use App\Models\Report;
use App\Repositories\ReportRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ReportRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new ReportRepository(new Report());
    }

    public function test_can_create()
    {
        $data = Report::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('reports', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = Report::factory()->create();
        $updated = $this->repository->update(['reason' => 'Updated'], $model->id);

        $this->assertEquals('Updated', $updated->reason);
    }

    public function test_can_delete()
    {
        $model = Report::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('reports', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = Report::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
