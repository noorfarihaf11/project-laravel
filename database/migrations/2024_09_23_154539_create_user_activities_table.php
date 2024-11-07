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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id('no_activity')->primary();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->string('description');
            $table->string('status');
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->foreign('menu_id')->references('menu_id')->on('menus');
            $table->string('delete_mark')->nullable();
            $table->string('create_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
