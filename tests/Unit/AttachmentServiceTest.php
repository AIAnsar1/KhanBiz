<?php

namespace Tests\Unit;

use App\Models\Attachment;
use App\Services\AttachmentService;
use App\Repositories\AttachmentRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttachmentServiceTest extends TestCase
{
    use RefreshDatabase;

    private AttachmentService $service;


    protected function setUp(): void
    {
        parent::setUp();
        $repo = new AttachmentRepository(new Attachment());
        $this->service = new AttachmentService($repo);
    }

    public function test_create_model()
    {
        $data = Attachment::factory()->make()->toArray();
        $model = $this->service->createModel($data);

        $this->assertDatabaseHas('attachments', ['id' => $model->id]);
    }

    public function test_update_model()
    {
        $model = Attachment::factory()->create();
        $updated = $this->service->updateModel(['owner_type' => 'New Service'], $model->id);

        $this->assertEquals('New Service', $updated->owner_type);
    }

    public function test_delete_model()
    {
        $model = Attachment::factory()->create();
        $this->service->deleteModel($model->id);

        $this->assertDatabaseMissing('attachments', ['id' => $model->id]);
    }

}