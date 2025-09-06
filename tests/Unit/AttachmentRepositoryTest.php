<?php

namespace Tests\Unit;

use App\Models\Attachment;
use App\Repositories\AttachmentRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttachmentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private AttachmentRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new AttachmentRepository(new Attachment());
    }

    public function test_can_create()
    {
        $data = Attachment::factory()->make()->toArray();
        $model = $this->repository->create($data);

        $this->assertDatabaseHas('attachments', ['id' => $model->id]);
    }

    public function test_can_update()
    {
        $model = Attachment::factory()->create();
        $updated = $this->repository->update(['owner_type' => 'Updated'], $model->id);

        $this->assertEquals('Updated', $updated->owner_type);
    }

    public function test_can_delete()
    {
        $model = Attachment::factory()->create();
        $this->repository->delete($model->id);

        $this->assertDatabaseMissing('attachments', ['id' => $model->id]);
    }

    public function test_can_find()
    {
        $model = Attachment::factory()->create();
        $found = $this->repository->findById($model->id);

        $this->assertEquals($model->id, $found->id);
    }
}
