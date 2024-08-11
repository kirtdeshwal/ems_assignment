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
        Schema::create('event_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('company_id');
            $table->double('vat_rate');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_payments');
    }
};
