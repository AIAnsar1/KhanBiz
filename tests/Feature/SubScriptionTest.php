<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{SubScription, Companies, Plan};

class SubScriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_subscription_index_request(): void
    {
        $response = $this->get("/api/application/sub-scriptions");
        $response->assertStatus(200);
    }

    public function test_post_subscription_store_request(): void
    {
        $company = Companies::factory()->create();
        $plan = Plan::factory()->create();

        $payload = [
            'starts_at'      => now(),
            'ends_at'        => now()->addMonth(),
            'remaining_bids' => 10,
            'status'         => 'expired',
            'company_id'     => $company->id,
            'plan_id'        => $plan->id,
        ];

        $response = $this->post("/api/application/sub-scriptions", $payload);
        $response->assertStatus(201);

        $this->assertDatabaseHas('sub_scriptions', [
            'company_id'     => $company->id,
            'plan_id'        => $plan->id,
            'remaining_bids' => 10,
            'status'         => 'expired',
        ]);
    }

    public function test_get_subscription_show_request(): void
    {
        $subscription = SubScription::factory()->create();
        $find = SubScription::find($subscription->id);

        $response = $this->get("/api/application/sub-scriptions/{$subscription->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_subscription_update_request(): void
    {
        $subscription = SubScription::factory()->create();
        $payload = [
            'starts_at'      => now(),
            'ends_at'        => now()->addMonths(2),
            'remaining_bids' => 20,
            'status'         => 'cancelled',
            'company_id'     => $subscription->company_id,
            'plan_id'        => $subscription->plan_id,
        ];

        $response = $this->put("/api/application/sub-scriptions/{$subscription->id}", $payload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('sub_scriptions', [
            'id'             => $subscription->id,
            'remaining_bids' => 20,
            'status'         => 'cancelled',
        ]);
    }

    public function test_delete_subscription_delete_request(): void
    {
        $subscription = SubScription::factory()->create();

        $response = $this->delete("/api/application/sub-scriptions/{$subscription->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('sub_scriptions', ['id' => $subscription->id]);
    }
}