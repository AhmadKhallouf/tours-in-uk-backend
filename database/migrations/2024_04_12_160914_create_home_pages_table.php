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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();

            $table->string('hero_title');
            $table->string('hero_body');

            $table->string('tours_title');
            $table->string('tours_body');
            $table->foreignId('tour1_id')->nullable()->references('id')->on('tours');
            $table->foreignId('tour2_id')->nullable()->references('id')->on('tours');
            $table->foreignId('tour3_id')->nullable()->references('id')->on('tours');

            $table->string('services_title');
            $table->string('services_body');
            $table->string('services_image_1');
            $table->string('services_image_2');
            $table->string('services_image_3');

            $table->string('specialities_title');

            $table->string('speciality_title_1');
            $table->string('speciality_subtitle_1');
            $table->string('speciality_icon_1');

            $table->string('speciality_title_2');
            $table->string('speciality_subtitle_2');
            $table->string('speciality_icon_2');

            $table->string('speciality_title_3');
            $table->string('speciality_subtitle_3');
            $table->string('speciality_icon_3');

            $table->string('join_title');
            $table->string('join_body');
            $table->string('join_image');

            $table->string('about_title');
            $table->text('about_paragraph');
            $table->string('about_highlight_box');
            $table->string('about_image_1');
            $table->string('about_image_2');

            $table->string('testimonials_title');

            $table->foreignId('contact_section_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
