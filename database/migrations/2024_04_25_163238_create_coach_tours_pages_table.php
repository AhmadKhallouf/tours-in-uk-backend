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
        Schema::create('coach_tours_pages', function (Blueprint $table) {
            $table->id();

            $table->string('hero_title');
            $table->string('hero_description');

            $table->string('box_image');
            $table->text('box_text');

            $table->string('services_box_title');
            $table->string('services_box_description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coach_tours_pages');
    }
};
