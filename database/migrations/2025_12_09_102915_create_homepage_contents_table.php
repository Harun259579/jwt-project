<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('homepage_contents', function (Blueprint $table) {
            $table->id();

            $table->string('page')->nullable();
            $table->string('section')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->text('description')->nullable();
            $table->text('sub_description')->nullable();
            $table->text('main_text')->nullable();
            $table->text('sub_text')->nullable();
            $table->string('button_text')->nullable();
            $table->string('sub_button_text')->nullable();
            $table->string('link_url')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('homepage_contents');
    }
};
