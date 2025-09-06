<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Attachment;

class AttachmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_attachment_inext_request(): void
    {
        $response = $this->get("/api/application/attachments");
        $response->assertStatus(200);
    }

    public function test_post_attachment_store_request(): void
    {
        $payload = [
            'owner_type' => 'tender',
            'owner_id'   => 1,
            'disk'       => 's3',
            'path'       => 'uploads/docs/file.pdf',
            'mime'       => 'application/pdf',
            'size'       => 123456,
        ];

        $response = $this->post("/api/application/attachments", $payload);
        $response->assertStatus(201);

        $this->assertDatabaseHas('attachments', [
            'owner_type' => 'tender',
            'owner_id'   => 1,
            'path'       => 'uploads/docs/file.pdf',
            'mime'       => 'application/pdf',
            'size'       => 123456,
        ]);
    }

    public function test_get_attachment_show_request(): void
    {
        $attachment = Attachment::factory()->create();
        $find = Attachment::find($attachment->id);

        $response = $this->get("/api/application/attachments/{$attachment->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_attachment_update_request(): void
    {
        $attachment = Attachment::factory()->create();

        $payload = [
            'owner_type' => 'company',
            'owner_id'   => 2,
            'disk'       => 's3',
            'path'       => 'uploads/images/logo.png',
            'mime'       => 'image/png',
            'size'       => 98765,
        ];

        $response = $this->put("/api/application/attachments/{$attachment->id}", $payload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('attachments', [
            'id'         => $attachment->id,
            'owner_type' => 'company',
            'owner_id'   => 2,
            'path'       => 'uploads/images/logo.png',
            'mime'       => 'image/png',
            'size'       => 98765,
        ]);
    }

    public function test_delete_attachment_delete_request(): void
    {
        $attachment = Attachment::factory()->create();

        $response = $this->delete("/api/application/attachments/{$attachment->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('attachments', ['id' => $attachment->id]);
    }
}