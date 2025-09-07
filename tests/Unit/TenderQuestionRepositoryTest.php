<?php

namespace Tests\Unit;

use App\Models\TenderQuestion;
use App\Repositories\TenderQuestionRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenderQuestionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private TenderQuestionRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new TenderQuestionRepository(new TenderQuestion());
    }

    public function test_can_create()
    {
        $data = TenderQuestion::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('tender_questions', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = TenderQuestion::factory()->create();
        $updated = $this->repository->update(['question' => 'Updated'], $model->id);

        $this->assertEquals('Updated', $updated->question);
    }

    public function test_can_delete()
    {
        $model = TenderQuestion::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('tender_questions', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = TenderQuestion::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
