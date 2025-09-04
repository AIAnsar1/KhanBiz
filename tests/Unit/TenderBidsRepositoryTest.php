<?php

namespace Tests\Unit;

use App\Models\TenderBids;
use App\Repositories\TenderBidsRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenderBidsRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private TenderBidsRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new TenderBidsRepository(new TenderBids());
    }

    public function test_can_create()
    {
        $data = TenderBids::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('tender_bids', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = TenderBids::factory()->create();
        $updated = $this->repository->update([
            'message' => 'Updated'
        ], $model->id);
        $this->assertEquals('Updated', $updated->message);
    }

    public function test_can_delete()
    {
        $model = TenderBids::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('tender_bids', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = TenderBids::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
