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
        Schema::create('posts', function (Blueprint $table) {
            $table->id('id_post')->primary();
            $table->string('title');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('id_category');
            $table->foreign('author_id')->references('id_user')->on('users'); 
            $table->foreign('id_category')->references('id_category')->on('categories');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('body');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};