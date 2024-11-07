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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('id_komen');
            $table->text('comments');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('komen_id')->nullable();;
            $table->foreign('id_post')->references('id_post')->on('posts'); 
            $table->foreign('author_id')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_comments');
    }
};
