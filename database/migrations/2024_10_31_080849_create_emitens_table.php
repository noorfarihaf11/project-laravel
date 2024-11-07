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
        Schema::create('emiten', function (Blueprint $table) {
            $table->string('stock_kode', 4)->primary(); // Set 'stock_kode' as the primary key
            $table->string('stock_name', 100);
            $table->string('shared'); // Change to integer or appropriate type
            $table->string('sektor', 60);
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emitens');
    }
};
