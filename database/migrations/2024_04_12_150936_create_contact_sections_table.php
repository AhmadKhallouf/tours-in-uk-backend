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
        Schema::create('contact_sections', function (Blueprint $table) {
            $table->id();

            $table->string('connect_box_title');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('facebook_link');
            $table->string('youtube_link');
            $table->string('whatsapp_link');
            $table->string('other_link')->nullable();

            $table->string('form_title');

            $table->string('footer_image');
            $table->text('text_on_footer_image');

            $table->string('footer_title');
            $table->text('footer_body');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_sections');
    }
};
