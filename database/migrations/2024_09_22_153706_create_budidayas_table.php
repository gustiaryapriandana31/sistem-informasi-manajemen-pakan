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
        Schema::create('budidayas', function (Blueprint $table) {
            $table->string('id_budidaya', 50)->primary();
            $table->string('nama_budidaya', 100);
            $table->foreignId('id_ikan')->references('id')->on('ikans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_pakan')->references('id')->on('pakans')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_tebar_ikan');
            $table->decimal('bobot_awal_ikan', 10, 2);
            $table->string('lama_budidaya');
            $table->date('tanggal_tebar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budidayas');
    }
};