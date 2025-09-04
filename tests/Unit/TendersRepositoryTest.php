<?php

namespace Tests\Unit;

use App\Models\Tenders;
use App\Repositories\TendersRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TendersRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private TendersRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new TendersRepository(new Tenders());
    }

    public function test_can_create()
    {
        $data = Tenders::factory()->make()->toArray();
        $model = $this->repository->create($data);
        $this->assertDatabaseHas('tenders', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = Tenders::factory()->create();
        $updated = $this->repository->update([
            'title' => 'Updated Tender Title',
            'description' => 'Updated description',
            'status' => 'published'
        ], $model->id);
        $this->assertEquals('Updated Tender Title', $updated->title);
    }

    public function test_can_delete()
    {
        $model = Tenders::factory()->create();
        $this->repository->delete($model->id);
        $this->assertDatabaseMissing('tenders', [
            'id' => $model->id
        ]);
    }

    public function test_can_find()
    {
        $model = Tenders::factory()->create();
        $found = $this->repository->findById($model->id);
        $this->assertEquals($model->id, $found->id);
    }
}
