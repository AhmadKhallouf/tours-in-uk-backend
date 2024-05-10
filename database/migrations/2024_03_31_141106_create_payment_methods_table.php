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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('processor_id')->nullable();
            $table->string('brand');
            $table->string('last_four'); // The last four digits of card number
            $table->tinyInteger('exp_month');
            $table->smallInteger('exp_year');
            $table->string('type');
            $table->string('name_on_card')->nullable(); // Optional based on whether the info is available
            $table->string('country', 2)->nullable(); // Optional, and using ISO 3166-1 alpha-2 country codes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
