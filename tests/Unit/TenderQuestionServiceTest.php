<?php

namespace Tests\Unit;

use App\Models\TenderQuestion;
use App\Services\TenderQuestionService;
use App\Repositories\TenderQuestionRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenderQuestionServiceTest extends TestCase
{
    use RefreshDatabase;

    private TenderQuestionService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new TenderQuestionRepository(new TenderQuestion());
        $this->service = new TenderQuestionService($repo);
    }

    public function test_create_model()
    {
        $data = TenderQuestion::factory()->make()->toArray();
        $model = $this->service->createModel($data);

        $this->assertDatabaseHas('tender_questions', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = TenderQuestion::factory()->create();
        $updated = $this->service->updateModel(['question' => 'New Question'], $model->id);

        $this->assertEquals('New Question', $updated->question);
    }

    public function test_delete_model()
    {
        $model = TenderQuestion::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('tender_questions', ['id' => $model->id]);
    }

}