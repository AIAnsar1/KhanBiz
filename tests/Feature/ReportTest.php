<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Report, Companies};

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_report_index_request(): void
    {
        $response = $this->get("/api/application/reports");
        $response->assertStatus(200);
    }

    public function test_post_report_store_request(): void
    {
        $company = Companies::factory()->create();

        $payload = [
            'target_type'         => 'message',
            'target_id'           => 1,
            'reason'              => 'Inappropriate content',
            'status'              => 'open',
            'reporter_company_id' => $company->id,
        ];

        $response = $this->post("/api/application/reports", $payload);
        $response->assertStatus(201);

        $this->assertDatabaseHas('reports', [
            'target_type' => 'message',
            'status'      => 'open',
            'reason'      => 'Inappropriate content',
        ]);
    }

    public function test_get_report_show_request(): void
    {
        $report = Report::factory()->create();
        $find = Report::find($report->id);

        $response = $this->get("/api/application/reports/{$report->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_report_update_request(): void
    {
        $company = Companies::factory()->create();
        $report = Report::factory()->create([
            'reporter_company_id' => $company->id,
            'target_type'         => 'message',
            'target_id'           => 1,
        ]);

        $payload = [
            'target_type'         => 'message',
            'target_id'           => 1,
            'reason'              => 'Updated reason',
            'status'              => 'review',
            'reporter_company_id' => $company->id,
        ];

        $response = $this->put("/api/application/reports/{$report->id}", $payload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('reports', [
            'id'     => $report->id,
            'reason' => 'Updated reason',
            'status' => 'review',
        ]);
    }

    public function test_delete_report_delete_request(): void
    {
        $report = Report::factory()->create();

        $response = $this->delete("/api/application/reports/{$report->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('reports', ['id' => $report->id]);
    }
}
