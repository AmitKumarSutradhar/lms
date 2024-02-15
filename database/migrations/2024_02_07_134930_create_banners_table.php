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
        Schema::create('banners', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('title_one');
            $table->string('title_two')->nullable();
            $table->string('image_url')->nullable(); // URL or path to the banner image
            $table->string('banner_type'); // Type of the banner (e.g., promo, featured, etc.)
            $table->integer('position'); // Position/order of the banner
            $table->text('description')->nullable(); // Optional description for the banner
            $table->text('button_one_link')->nullable(); // Optional description for the banner
            $table->text('button_one_text')->nullable(); // Optional description for the banner
            $table->text('button_two_text')->nullable(); // Optional description for the banner
            $table->text('button_two_link')->nullable(); // Optional description for the banner
            $table->timestamp('start_date')->nullable(); // Start date for displaying the banner
            $table->timestamp('end_date')->nullable(); // End date for displaying the banner
            $table->boolean('is_active')->default(true); // Indicates if the banner is currently active
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
