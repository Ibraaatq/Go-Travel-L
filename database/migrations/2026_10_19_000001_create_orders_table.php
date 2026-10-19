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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('paket_slug');
            $table->string('nama_paket');
            $table->string('kota_keberangkatan');
            $table->string('tanggal_keberangkatan');
            $table->string('titik_kumpul');
            $table->integer('jumlah_peserta');
            $table->text('catatan')->nullable();
            $table->string('nama_pemesan');
            $table->string('nomor_hp');
            $table->string('email_pemesan');
            $table->string('nama_instansi')->nullable();
            $table->string('skema_pembayaran');
            $table->decimal('total_pembayaran', 15, 2);
            $table->string('status')->default('dipending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
