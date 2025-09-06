<?php

namespace Tests\Unit;

use App\Models\Message;
use App\Services\MessageService;
use App\Repositories\MessageRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageServiceTest extends TestCase
{
    use RefreshDatabase;

    private MessageService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new MessageRepository(new Message());
        $this->service = new MessageService($repo);
    }

    public function test_create_model()
    {
        $data = Message::factory()->make()->toArray();
        $model = $this->service->createModel($data);

        $this->assertDatabaseHas('messages', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = Message::factory()->create();
        $updated = $this->service->updateModel(['body' => 'thread_type'], $model->id);

        $this->assertEquals('thread_type', $updated->body);
    }

    public function test_delete_model()
    {
        $model = Message::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('messages', ['id' => $model->id]);
    }

}