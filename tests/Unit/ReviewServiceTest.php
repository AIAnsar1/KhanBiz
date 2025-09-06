<?php

namespace Tests\Unit;

use App\Models\Review;
use App\Services\ReviewService;
use App\Repositories\ReviewRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewServiceTest extends TestCase
{
    use RefreshDatabase;

    private ReviewService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new ReviewRepository(new Review());
        $this->service = new ReviewService($repo);
    }

    public function test_create_model()
    {
        $data = Review::factory()->make()->toArray();
        $model = $this->service->createModel($data);

        $this->assertDatabaseHas('reviews', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = Review::factory()->create();
        $updated = $this->service->updateModel(['comment' => 'New Service'], $model->id);

        $this->assertEquals('New Service', $updated->comment);
    }

    public function test_delete_model()
    {
        $model = Review::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('reviews', ['id' => $model->id]);
    }

}