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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('legal_name');
            $table->string('brand_name')->nullable();
            $table->string('tin', 64)->nullable();
            $table->char('country_code', 2);
            $table->string('city', 120)->nullable();
            $table->text('address')->nullable();
            $table->string('website', 255)->nullable();
            $table->timestampTz('verified_at')->nullable();
            $table->jsonb('about')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
