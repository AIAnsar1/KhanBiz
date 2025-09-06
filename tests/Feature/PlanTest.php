<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Plan;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_plan_index_request(): void
    {
        $response = $this->get("/api/application/plans");
        $response->assertStatus(200);
    }

    public function test_post_plan_store_request(): void
    {
        $payload = [
            'code'      => 'basic_plan',
            'title'     => ['en' => 'Basic Plan', 'ru' => 'Базовый план'],
            'price'     => 49.99,
            'currency'  => 'USD',
            'bid_limit' => 100,
            'features'  => ['support' => 'email', 'ads' => false],
            'active'    => true,
        ];

        $response = $this->post("/api/application/plans", $payload);
        $response->assertStatus(201);

        $this->assertDatabaseHas('plans', [
            'code'      => 'basic_plan',
            'currency'  => 'USD',
            'bid_limit' => 100,
        ]);
    }

    public function test_get_plan_show_request(): void
    {
        $plan = Plan::factory()->create();
        $find = Plan::find($plan->id);

        $response = $this->get("/api/application/plans/{$plan->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_plan_update_request(): void
    {
        $plan = Plan::factory()->create();

        $payload = [
            'code'      => 'pro_plan',
            'title'     => ['en' => 'Pro Plan', 'ru' => 'Профессиональный план'],
            'price'     => 99.99,
            'currency'  => 'EUR',
            'bid_limit' => 500,
            'features'  => ['support' => 'priority', 'ads' => false],
            'active'    => false,
        ];

        $response = $this->put("/api/application/plans/{$plan->id}", $payload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('plans', [
            'id'        => $plan->id,
            'code'      => 'pro_plan',
            'currency'  => 'EUR',
            'bid_limit' => 500,
            'active'    => false,
        ]);
    }

    public function test_delete_plan_delete_request(): void
    {
        $plan = Plan::factory()->create();

        $response = $this->delete("/api/application/plans/{$plan->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('plans', ['id' => $plan->id]);
    }
}