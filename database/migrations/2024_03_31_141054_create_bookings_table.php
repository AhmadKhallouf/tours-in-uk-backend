<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->morphs('bookable');

            $table->dateTime('date');

            $table->string('name');
            $table->string('phone');

            $table->integer('guests_count');

            $table->foreignId('partner_id')->nullable();

            $table->decimal('price_per_guest');
            $table->decimal('net_profit');
            $table->decimal('partner_share')->nullable();

            $table->string('payment_status')->default('pending');

            $table->text('message')->nullable();

            // VIP service specific
            $table->string('destination')->nullable();

            $table->foreignId('vehicle_id')->nullable();
            $table->foreignId('driver_id')->nullable();

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
