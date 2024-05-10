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
        Schema::create('about_us_pages', function (Blueprint $table) {
            $table->id();

                $table->string('title_1');
                $table->text('paragraph_1');
                $table->string('image_1');

                $table->string('title_2');
                $table->text('paragraph_2');
                $table->string('highlight_box_2');
                $table->string('image_2_1');
                $table->string('image_2_2');

                $table->foreignId('contact_section_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_pages');
    }
};
