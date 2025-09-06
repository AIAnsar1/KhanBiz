<?php

namespace Tests\Feature;

use App\Models\Companies;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Message, Tenders, User};

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_message_inext_request(): void
    {
        $response = $this->get("/api/application/messages");
        $response->assertStatus(200);
    }

    public function test_post_message_store_request(): void
    {
        $user = User::factory()->create();
        $company = Companies::factory()->create();

        // допустим, thread_type = "tender"
        $tender = Tenders::factory()->create();

        $response = $this->post("/api/application/messages", [
            'thread_type'     => 'tender',
            'thread_id'       => $tender->id,
            'from_company_id' => $company->id,
            'from_user_id'    => $user->id,
            'body'            => 'body',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('messages', [
            'thread_type'     => 'tender',
            'thread_id'       => $tender->id,
            'from_company_id' => $company->id,
            'from_user_id'    => $user->id,
            'body'            => 'body',
        ]);
    }

    public function test_get_message_show_request(): void
    {
        $message = Message::factory()->create();
        $find = Message::find($message->id);
        $response = $this->get("/api/application/messages/{$message->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_message_update_request(): void
    {
        $user = User::factory()->create();
        $company = Companies::factory()->create();
        $tender = Tenders::factory()->create();
        $message = Message::factory()->create([
            'from_company_id' => $company->id,
            'from_user_id'    => $user->id,
        ]);
        $response = $this->put("/api/application/messages/{$message->id}", [
            'thread_type'     => 'bid',
            'thread_id'       => $tender->id,
            'from_company_id' => $company->id,
            'from_user_id'    => $user->id,
            'body'            => 'updated body',
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('messages', [
            'id'              => $message->id,
            'thread_type'     => 'bid',
            'body'            => 'updated body',
        ]);
    }

    public function test_delete_message_delete_request(): void
    {
        $message = Message::factory()->create();
        $response = $this->delete("/api/application/messages/{$message->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('messages', ['id' => $message->id]);
    }
}
