<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('rating');
            $table->text('comment')->nullable();
            $table->unique(['from_company_id','to_company_id','tender_id']);
            $table->foreignId('from_company_id')->constrained('companies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('to_company_id')->constrained('companies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tender_id')->nullable()->constrained('tenders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE reviews ADD CONSTRAINT reviews_rating_check CHECK (rating BETWEEN 1 AND 5)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE reviews DROP CONSTRAINT reviews_rating_check");
        Schema::dropIfExists('reviews');
    }
};
