<?php

namespace Tests\Feature;

use App\Models\{Category, Companies, Locations};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Tenders;

class TendersTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_tenders_inext_request(): void
    {
        $response = $this->get("/api/application/tenders");
        $response->assertStatus(200);
    }

    public function test_post_tenders_store_request(): void
    {
        $company = Companies::factory()->create();
        $category = Category::factory()->create();
        $location = Locations::factory()->create();

        $response = $this->post("/api/application/tenders", [
            'title' => 'New Tender',
            'description' => 'Test tender description',
            'budget_amount' => 10000.00,
            'currency' => 'USD',
            'bids_deadline' => now()->addDays(30)->toDateTimeString(),
            'status' => 'draft',
            'visibility' => 'public',
            'company_id' => $company->id,
            'category_id' => $category->id,
            'location_id' => $location->id,
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('tenders', [
            'title' => 'New Tender',
            'description' => 'Test tender description',
            'budget_amount' => 10000.00,
            'currency' => 'USD',
            'bids_deadline' => now()->addDays(30)->toDateTimeString(),
            'status' => 'draft',
            'visibility' => 'public',
            'company_id' => $company->id,
            'category_id' => $category->id,
            'location_id' => $location->id
        ]);
    }

    public function test_get_tenders_show_request(): void
    {
        $tenders = Tenders::factory()->create();
        $find = Tenders::find($tenders->id);
        $response = $this->get("/api/application/tenders/{$tenders->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_tenders_update_request(): void
    {
        $company = Companies::factory()->create();
        $category = Category::factory()->create();
        $location = Locations::factory()->create();

        $tenders = Tenders::factory()->create([
            'company_id' => $company->id,
            'category_id' => $category->id,
            'location_id' => $location->id,
        ]);
        $response = $this->put("/api/application/tenders/{$tenders->id}", [
            'title' => 'New Tender',
            'description' => 'Test tender description',
            'budget_amount' => 20000.00, // теперь совпадает с assertDatabaseHas
            'currency' => 'USD',
            'bids_deadline' => now()->addDays(30)->toDateTimeString(),
            'status' => 'draft',
            'visibility' => 'public',
            'company_id' => $company->id,
            'category_id' => $category->id,
            'location_id' => $location->id,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tenders', [
            'id' => $tenders->id,
            'title' => 'New Tender',
            'description' => 'Test tender description',
            'budget_amount' => 20000.00, // совпадает с payload
            'currency' => 'USD',
        ]);
    }

    public function test_delete_tenders_delete_request(): void
    {
        $tenders = Tenders::factory()->create();
        $response = $this->delete("/api/application/tenders/{$tenders->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tenders', ['id' => $tenders->id]);
    }
}
