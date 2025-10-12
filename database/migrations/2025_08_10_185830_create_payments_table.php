<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['credit_card', 'paypal', 'stripe'])->default('stripe');
            $table->enum('status', ['pending', 'completed', 'failed', 'requires_payment_method'])->default('pending');
            $table->string('transaction_id', 255)->nullable();
            $table->string('stripe_payment_intent_id')->nullable()->unique();
            $table->string('stripe_client_secret')->nullable();
            $table->string('currency')->default('usd');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};