<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Invoice, Plan, Companies};

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_invoice_index_request(): void
    {
        $response = $this->get("/api/application/invoices");
        $response->assertStatus(200);
    }

    public function test_post_invoice_store_request(): void
    {
        $company = Companies::factory()->create();
        $plan = Plan::factory()->create();

        $payload = [
            'amount'     => 199.99,
            'currency'   => 'USD',
            'status'     => 'pending',
            'company_id' => $company->id,
            'plan_id'    => $plan->id,
            'provider'   => 'Stripe',
            'provider_invoice_id' => 'inv_123456',
            'paid_at'    => now()->toDateTimeString(),
        ];

        $response = $this->post("/api/application/invoices", $payload);
        $response->assertStatus(201);

        $this->assertDatabaseHas('invoices', [
            'amount'     => 199.99,
            'currency'   => 'USD',
            'status'     => 'pending',
            'company_id' => $company->id,
            'plan_id'    => $plan->id,
        ]);
    }

    public function test_get_invoice_show_request(): void
    {
        $invoice = Invoice::factory()->create();
        $find = Invoice::find($invoice->id);

        $response = $this->get("/api/application/invoices/{$invoice->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
    }

    public function test_put_invoice_update_request(): void
    {
        $company = Companies::factory()->create();
        $plan = Plan::factory()->create();
        $invoice = Invoice::factory()->create();
        $payload = [
            'amount'     => 299.50,
            'currency'   => 'EUR',
            'status'     => 'paid',
            'company_id' => $company->id,
            'plan_id'    => $plan->id,
            'provider'   => 'Stripe',
            'provider_invoice_id' => 'inv_123456',
            'paid_at'    => now()->toDateTimeString(),
        ];
        $response = $this->put("/api/application/invoices/{$invoice->id}", $payload);
        $response->assertStatus(200);
        $this->assertDatabaseHas('invoices', [
            'id'       => $invoice->id,
            'amount'   => 299.50,
            'currency' => 'EUR',
            'status'   => 'paid',
            'provider' => 'Stripe',
            'provider_invoice_id' => 'inv_123456',
        ]);
    }

    public function test_delete_invoice_delete_request(): void
    {
        $invoice = Invoice::factory()->create();

        $response = $this->delete("/api/application/invoices/{$invoice->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('invoices', ['id' => $invoice->id]);
    }
}
