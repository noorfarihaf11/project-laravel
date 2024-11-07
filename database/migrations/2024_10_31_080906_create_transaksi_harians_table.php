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
        Schema::create('transaksi_harian', function (Blueprint $table) {
            $table->string('no_record')->primary();;
            $table->string('stock_kode', 4);
            $table->timestamp('date_transaction')->nullable();
            $table->integer('open'); 
            $table->integer('high'); 
            $table->integer('low'); 
            $table->integer('close'); 
            $table->integer('change'); 
            $table->integer('volume'); 
            $table->string('value'); 
            $table->integer('frequency');
            $table->foreign('stock_kode')->references('stock_kode')->on('emiten');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_harians');
    }
};
