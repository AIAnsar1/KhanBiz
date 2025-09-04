<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Companies, TenderBids, Tenders};

class TenderBidsTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_tenderbids_inext_request(): void
    {
        $response = $this->get("/api/application/tender-bids");
        $response->assertStatus(200);
    }

    public function test_post_tenderbids_store_request(): void
    {
        $tender = Tenders::factory()->create();
        $company = Companies::factory()->create();
        
        $response = $this->post("/api/application/tender-bids", [
            'amount' => '1000',
            'currency' => 'USD',
            'message' => 'Message',
            'status' => 'submitted',
            'tender_id' => $tender->id,
            'supplier_company_id' => $company->id,
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('tender_bids', [
            'amount' => '1000',
            'currency' => 'USD',
            'message' => 'Message',
            'status' => 'submitted',
            'tender_id' => $tender->id,
            'supplier_company_id' => $company->id,
        ]);
    }

    public function test_get_tenderbids_show_request(): void
    {
        $tenderbids = TenderBids::factory()->create();
        $find = TenderBids::find($tenderbids->id);
        $response = $this->get("/api/application/tender-bids/{$tenderbids->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_tenderbids_update_request(): void
    {
        $tender = Tenders::factory()->create();
        $company = Companies::factory()->create();
        $tenderbids = TenderBids::factory()->create([
            'tender_id' => $tender->id,
            'supplier_company_id' => $company->id,
        ]);
        $response = $this->put("/api/application/tender-bids/{$tenderbids->id}", [
            'amount' => '1000',
            'currency' => 'USD',
            'message' => 'Message',
            'status' => 'submitted',
            'tender_id' => $tender->id,
            'supplier_company_id' => $company->id,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tender_bids', [
            'id' => $tenderbids->id,
            'amount' => '1000',
            'currency' => 'USD',
            'message' => 'Message',
            'status' => 'submitted',
        ]);
    }

    public function test_delete_tenderbids_delete_request(): void
    {
        $tenderbids = TenderBids::factory()->create();
        $response = $this->delete("/api/application/tender-bids/{$tenderbids->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tender_bids', ['id' => $tenderbids->id]);
    }
}
