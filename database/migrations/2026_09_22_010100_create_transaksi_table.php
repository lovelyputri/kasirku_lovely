<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal');
            $table->bigInteger('total_bayar'); 

            $table->timestamps();
        });
    }

    /**
     * Membalikkan migrasi (rollback) dengan menghapus tabel `transaksi`.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
