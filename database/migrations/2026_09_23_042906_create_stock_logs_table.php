<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration — membuat tabel stock_logs.
     */
    public function up(): void
    {
        Schema::create('stock_logs', function (Blueprint $table) {
            $table->id();

            // nullable() + nullOnDelete(): kalau Product dihapus,
            // baris log ini TIDAK ikut terhapus. Kolom product_id
            // cuma diisi NULL — riwayat tetap tersimpan sebagai
            // jejak historis (sesuai keputusan Opsi B yang disetujui).
            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->integer('previous_stock');
            $table->integer('new_stock');

            // Disimpan sebagai string biasa ('in' / 'out'), nanti
            // di-cast otomatis jadi StockAction enum lewat Model.
            $table->string('action_type');

            $table->text('notes')->nullable();

            // Cuma created_at, TIDAK ada updated_at — karena log
            // adalah catatan sejarah yang sekali tercatat tidak
            // boleh diubah lagi.
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Batalkan migration — hapus tabel stock_logs.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
    }
};