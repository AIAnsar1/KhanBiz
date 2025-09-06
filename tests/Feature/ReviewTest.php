<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Review, Companies, Tenders};

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_review_index_request(): void
    {
        $response = $this->get("/api/application/reviews");
        $response->assertStatus(200);
    }

    public function test_post_review_store_request(): void
    {
        $fromCompany = Companies::factory()->create();
        $toCompany   = Companies::factory()->create();
        $tender      = Tenders::factory()->create();

        $payload = [
            'rating'          => 5,
            'comment'         => 'Great cooperation!',
            'from_company_id' => $fromCompany->id,
            'to_company_id'   => $toCompany->id,
            'tender_id'       => $tender->id,
        ];

        $response = $this->post("/api/application/reviews", $payload);
        $response->assertStatus(201);

        $this->assertDatabaseHas('reviews', $payload);
    }

    public function test_get_review_show_request(): void
    {
        $review = Review::factory()->create();
        $response = $this->get("/api/application/reviews/{$review->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $review->id);
    }

    public function test_put_review_update_request(): void
    {
        $review = Review::factory()->create([
            'tender_id' => Tenders::factory()->create()->id, // гарантируем, что есть tender
        ]);

        $payload = [
            'rating'          => 4,
            'comment'         => 'Updated review',
            'from_company_id' => $review->from_company_id,
            'to_company_id'   => $review->to_company_id,
            'tender_id'       => $review->tender_id, // обязательно передаём
        ];

        $response = $this->put("/api/application/reviews/{$review->id}", $payload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('reviews', [
            'id'      => $review->id,
            'rating'  => 4,
            'comment' => 'Updated review',
        ]);
    }

    public function test_delete_review_delete_request(): void
    {
        $review = Review::factory()->create();
        $response = $this->delete("/api/application/reviews/{$review->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
    }
}
