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
        Schema::create('menu_users', function (Blueprint $table) {
            $table->id('no_seting')->primary();
            $table->unsignedBigInteger('id_jenis_user');
            $table->unsignedBigInteger('menu_id');
            $table->boolean('checked')->nullable();
            $table->foreign('id_jenis_user')->references('id_jenis_user')->on('jenis_users');
            $table->foreign('menu_id')->references('menu_id')->on('menus');
            $table->string('delete_mark', 1)->nullable();
            $table->string('update_by', 30)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_user');
    }
};