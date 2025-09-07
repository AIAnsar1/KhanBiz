<?php

namespace Tests\Unit;

use App\Models\Message;
use App\Repositories\MessageRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private MessageRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new MessageRepository(new Message());
    }

    public function test_can_create()
    {
        $data = Message::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('messages', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = Message::factory()->create();
        $updated = $this->repository->update(['thread_type' => 'thread_type'], $model->id);

        $this->assertEquals('thread_type', $updated->thread_type);
    }

    public function test_can_delete()
    {
        $model = Message::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('messages', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = Message::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
