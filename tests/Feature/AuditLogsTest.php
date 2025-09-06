<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{AuditLogs, Companies, User};

class AuditLogsTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_auditlogs_inext_request(): void
    {
        $response = $this->get("/api/application/audit-logs");
        $response->assertStatus(200);
    }

    public function test_post_auditlogs_store_request(): void
    {
        $user = User::factory()->create();
        $company = Companies::factory()->create();

        $payload = [
            'action'           => 'login',
            'subject_type'     => 'bid',
            'subject_id'       => 123,
            'meta'             => ['ip' => '127.0.0.1'],
            'actor_user_id'    => $user->id,
            'actor_company_id' => $company->id,
        ];

        $response = $this->post("/api/application/audit-logs", $payload);
        $response->assertStatus(201);

        $this->assertDatabaseHas('audit_logs', [
            'action'       => 'login',
            'subject_type' => 'bid',
            'subject_id'   => 123,
        ]);
    }

    public function test_get_auditlogs_show_request(): void
    {
        $auditlog = AuditLogs::factory()->create();
        $find = AuditLogs::find($auditlog->id);

        $response = $this->get("/api/application/audit-logs/{$auditlog->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_auditlogs_update_request(): void
    {
        $auditlog = AuditLogs::factory()->create();

        $payload = [
            'action'       => 'update',
            'subject_type' => 'tender',
            'subject_id'   => 456,
            'meta'         => ['ip' => '192.168.0.1'],
            'actor_user_id' => $auditlog->actor_user_id,
            'actor_company_id' => $auditlog->actor_company_id,
        ];

        $response = $this->put("/api/application/audit-logs/{$auditlog->id}", $payload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('audit_logs', [
            'id'           => $auditlog->id,
            'action'       => 'update',
            'subject_type' => 'tender',
            'subject_id'   => 456,
        ]);
    }

    public function test_delete_auditlogs_delete_request(): void
    {
        $auditlog = AuditLogs::factory()->create();

        $response = $this->delete("/api/application/audit-logs/{$auditlog->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('audit_logs', ['id' => $auditlog->id]);
    }
}
