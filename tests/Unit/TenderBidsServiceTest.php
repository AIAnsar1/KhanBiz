<?php

namespace Tests\Unit;

use App\Models\TenderBids;
use App\Services\TenderBidsService;
use App\Repositories\TenderBidsRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenderBidsServiceTest extends TestCase
{
    use RefreshDatabase;

    private TenderBidsService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new TenderBidsRepository(new TenderBids());
        $this->service = new TenderBidsService($repo);
    }

    public function test_create_model()
    {
        $data = TenderBids::factory()->make()->toArray();
        $model = $this->service->createModel($data);

        $this->assertDatabaseHas('tender_bids', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = TenderBids::factory()->create();
        $updated = $this->service->updateModel(['message' => 'New Service'], $model->id);

        $this->assertEquals('New Service', $updated->message);
    }

    public function test_delete_model()
    {
        $model = TenderBids::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('tender_bids', ['id' => $model->id]);
    }

}