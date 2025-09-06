<?php

namespace Tests\Unit;

use App\Models\Review;
use App\Repositories\ReviewRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ReviewRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new ReviewRepository(new Review());
    }

    public function test_can_create()
    {
        $data = Review::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('reviews', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = Review::factory()->create();
        $updated = $this->repository->update(['comment' => 'Updated'], $model->id);

        $this->assertEquals('Updated', $updated->comment);
    }

    public function test_can_delete()
    {
        $model = Review::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('reviews', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = Review::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
