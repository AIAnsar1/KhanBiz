<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Companies;

class CompaniesTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_companies_inext_request(): void
    {
        $response = $this->get("/api/application/companies");
        $response->assertStatus(200);
    }

    public function test_post_companies_store_request(): void
    {
        $response = $this->post("/api/application/companies", [
            'legal_name' => 'legal_name',
            'brand_name' => 'brand_name',
            'tin' => '1234567890',
            'country_code' => 'US',
            'city' => 'New York',
            'address' => '123 Street',
            'website' => 'https://example.com',
            'verified_at' => '2025-09-03 16:11:17',
            'about' => [
                'en' => 'About in English',
                'ru' => 'Описание на русском',
            ],
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('companies', [
            'legal_name' => 'legal_name',
            'brand_name' => 'brand_name',
            'tin' => '1234567890',
            'country_code' => 'US',
            'city' => 'New York',
            'address' => '123 Street',
            'website' => 'https://example.com',
            'verified_at' => '2025-09-03 16:11:17',
        ]);
        $this->assertEquals([
            'en' => 'About in English',
            'ru' => 'Описание на русском',
        ], Companies::latest()->first()->about);
    }

    public function test_get_companies_show_request(): void
    {
        $companies = Companies::factory()->create();
        $find = Companies::find($companies->id);
        $response = $this->get("/api/application/companies/{$companies->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_companies_update_request(): void
    {
        $companies = Companies::factory()->create();
        $response = $this->put("/api/application/companies/{$companies->id}", [
            'legal_name' => 'legal_name',
            'brand_name' => 'brand_name',
            'tin' => '1234567890',
            'country_code' => 'US',
            'city' => 'New York',
            'address' => '123 Street',
            'website' => 'https://example.com',
            'verified_at' => '2025-09-03 16:11:17',
            'about' => [
                'en' => 'About in English',
                'ru' => 'Описание на русском',
            ],
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('companies', [
            'legal_name' => 'legal_name',
            'brand_name' => 'brand_name',
            'tin' => '1234567890',
            'country_code' => 'US',
            'city' => 'New York',
            'address' => '123 Street',
            'website' => 'https://example.com',
            'verified_at' => '2025-09-03 16:11:17',
        ]);
        $this->assertEquals([
            'en' => 'About in English',
            'ru' => 'Описание на русском',
        ], Companies::latest()->first()->about);
    }

    public function test_delete_companies_delete_request(): void
    {
        $companies = Companies::factory()->create();
        $response = $this->delete("/api/application/companies/{$companies->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('companies', ['id' => $companies->id]);
    }
}
