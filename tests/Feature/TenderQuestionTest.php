<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\TenderQuestion;
use App\Models\{Tenders, Companies};

class TenderQuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_tenderquestion_index_request(): void
    {
        $response = $this->get("/api/application/tender-questions");
        $response->assertStatus(200);
    }

    public function test_post_tenderquestion_store_request(): void
    {
        $tender = Tenders::factory()->create();
        $company = Companies::factory()->create();

        $payload = [
            'tender_id'         => $tender->id,
            'author_company_id' => $company->id,
            'question'          => 'What is the delivery time?',
            'answer'            => 'Approximately 30 days',
            'answered_at'       => now()->toDateTimeString(),
        ];

        $response = $this->post("/api/application/tender-questions", $payload);
        $response->assertStatus(201);

        $this->assertDatabaseHas('tender_questions', [
            'tender_id'         => $tender->id,
            'author_company_id' => $company->id,
            'question'          => 'What is the delivery time?',
        ]);
    }

    public function test_get_tenderquestion_show_request(): void
    {
        $tenderquestion = TenderQuestion::factory()->create();
        $find = TenderQuestion::find($tenderquestion->id);

        $response = $this->get("/api/application/tender-questions/{$tenderquestion->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_tenderquestion_update_request(): void
    {
        $tenderquestion = TenderQuestion::factory()->create();

        $payload = [
            'tender_id'         => $tenderquestion->tender_id,
            'author_company_id' => $tenderquestion->author_company_id,
            'question'          => 'Updated question text',
            'answer'            => 'Updated answer',
            'answered_at'       => now()->toDateTimeString(),
        ];

        $response = $this->put("/api/application/tender-questions/{$tenderquestion->id}", $payload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('tender_questions', [
            'id'       => $tenderquestion->id,
            'question' => 'Updated question text',
            'answer'   => 'Updated answer',
        ]);
    }

    public function test_delete_tenderquestion_delete_request(): void
    {
        $tenderquestion = TenderQuestion::factory()->create();

        $response = $this->delete("/api/application/tender-questions/{$tenderquestion->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('tender_questions', ['id' => $tenderquestion->id]);
    }
}