<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tender_bids', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 18, 2);
            $table->string('currency', 3);
            $table->text('message');
            $table->enum('status', ['submitted', 'shortlisted', 'rejected', 'winner', 'withdrawn'])->default('submitted');
            $table->unique(['tender_id', 'supplier_company_id']);
            $table->index(['tender_id', 'status'], 'tender_bids_status_idx');
            $table->foreignId('tender_id')->constrained('tenders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('supplier_company_id')->constrained('companies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tender_bids');
    }
};
