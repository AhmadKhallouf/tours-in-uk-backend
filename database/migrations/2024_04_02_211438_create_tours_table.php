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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();

            $table->string('location');
            $table->string('environment'); // mountains, seaside...
            $table->string('city')->nullable();

            $table->time('check_in');
            $table->time('check_out');

            $table->date('first_day');
            $table->date('last_day');

            $table->boolean('is_available')->default(true);

            $table->integer('guests_count');

            $table->decimal('price');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
