<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Payment, Invoice};

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_payment_index_request(): void
    {
        $response = $this->get("/api/application/payments");
        $response->assertStatus(200);
    }

    public function test_post_payment_store_request(): void
    {
        $invoice = Invoice::factory()->create();

        $payload = [
            'amount'               => 100.50,
            'currency'             => 'USD',
            'provider'             => 'Stripe',
            'provider_payment_id'  => 'pay_123456',
            'status'               => 'succeeded',
            'invoice_id'           => $invoice->id,
        ];

        $response = $this->post("/api/application/payments", $payload);
        $response->assertStatus(201);

        $this->assertDatabaseHas('payments', [
            'amount'              => 100.50,
            'currency'            => 'USD',
            'provider'            => 'Stripe',
            'provider_payment_id' => 'pay_123456',
            'status'              => 'succeeded',
            'invoice_id'          => $invoice->id,
        ]);
    }

    public function test_get_payment_show_request(): void
    {
        $payment = Payment::factory()->create();
        $find = Payment::find($payment->id);

        $response = $this->get("/api/application/payments/{$payment->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_payment_update_request(): void
    {
        $payment = Payment::factory()->create();
        $invoice = Invoice::factory()->create();

        $payload = [
            'amount'               => 200.75,
            'currency'             => 'EUR',
            'provider'             => 'Stripe',
            'provider_payment_id'  => 'pay_654321',
            'status'               => 'refunded',
            'invoice_id'           => $invoice->id,
        ];

        $response = $this->put("/api/application/payments/{$payment->id}", $payload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('payments', [
            'id'                  => $payment->id,
            'amount'              => 200.75,
            'currency'            => 'EUR',
            'status'              => 'refunded',
            'provider'            => 'Stripe',
            'provider_payment_id' => 'pay_654321',
            'invoice_id'          => $invoice->id,
        ]);
    }

    public function test_delete_payment_delete_request(): void
    {
        $payment = Payment::factory()->create();

        $response = $this->delete("/api/application/payments/{$payment->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('payments', ['id' => $payment->id]);
    }
}