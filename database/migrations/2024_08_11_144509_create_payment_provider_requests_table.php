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
        Schema::create('payment_provider_requests', function (Blueprint $table) {
            $table->id();
            $table->string('payment_method_name');
            $table->string('website')->nullable();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('company_id');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_provider_requests');
    }
};
