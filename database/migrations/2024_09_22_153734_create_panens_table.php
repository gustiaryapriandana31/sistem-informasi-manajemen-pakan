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
        Schema::create('panens', function (Blueprint $table) {
            $table->string('id_budidaya', 50); 
            $table->decimal('bobot_akhir_ikan', 10, 2);
            $table->date('tanggal_panen');
            $table->timestamps();
            
            $table->primary(['id_budidaya', 'tanggal_panen']);
            $table->foreign('id_budidaya')->references('id_budidaya')->on('budidayas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panens');
    }
};