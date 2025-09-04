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
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->decimal('budget_amount', 18, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->timestampTz('bids_deadline')->nullable();
            $table->timestampTz('published_at')->nullable();
            $table->timestampTz('closed_at')->nullable();
            $table->enum('status', ['draft','pending','published','closed','cancelled']);
            $table->enum('visibility', ['public','invited'])->default('public');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained('locations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};
