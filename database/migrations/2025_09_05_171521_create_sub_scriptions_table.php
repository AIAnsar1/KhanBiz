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
        Schema::create('sub_scriptions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->integer('remaining_bids');
            $table->string('status', 24)->default('active');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained('plans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE sub_scriptions ADD CONSTRAINT sub_scriptions_status_check CHECK (status IN ('active','expired','cancelled'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE sub_scriptions DROP CONSTRAINT sub_scriptions_status_check");
        Schema::dropIfExists('sub_scriptions');
    }
};
