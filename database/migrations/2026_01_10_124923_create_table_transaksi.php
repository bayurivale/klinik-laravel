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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_pelanggan')
                ->constrained('pelanggan')
                ->onDelete('cascade');

            $table->foreignId('id_pegawai')
                ->nullable()
                ->constrained('pegawai')
                ->nullOnDelete();

            $table->foreignId('id_obat')
                ->constrained('obat')
                ->onDelete('cascade');

            $table->integer('jumlah');

            $table->decimal('total_bayar', 10, 2);

            $table->enum('status_transaksi', [
                'menunggu_pembayaran',
                'menunggu_verifikasi',
                'selesai',
                'ditolak'
            ])->default('menunggu_pembayaran');

            $table->string('bukti_pembayaran')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->timestamp('tanggal_transaksi')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
