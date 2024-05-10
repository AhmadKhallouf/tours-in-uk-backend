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
        Schema::create('contact_us_pages', function (Blueprint $table) {
            $table->id();

            $table->string('hero_title');
            $table->string('hero_body');

            $table->string('box_title');
            $table->string('box_image')->nullable();

            $table->foreignId('contact_section_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us_pages');
    }
};
