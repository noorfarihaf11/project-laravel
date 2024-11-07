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
        Schema::create('menus', function (Blueprint $table) {
           $table->id('menu_id');
            $table->unsignedBigInteger('id_level')->nullable();
            $table->foreign('id_level')->references('id_level')->on('menu_levels');
            $table->string('menu_name', 300);
            $table->string('menu_link', 300);
            $table->string('menu_icon', 300);
            $table->string('parent_id', 30)->nullable();;
            $table->string('create_by', 30)->nullable();
            $table->string('update_by', 30)->nullable();
            $table->string('delete_mark', 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
