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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->string('slug')->unique();
            $table->string('destinasi');
            $table->string('kategori');
            $table->string('durasi');
            $table->string('makan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 15, 2)->default(0);
            $table->string('harga_display')->nullable()->comment('Format tampilan harga, misal: Rp. 2.000.000');
            $table->string('gambar')->nullable()->comment('Path gambar di storage/packages/');
            $table->json('itinerary')->nullable()->comment('Rencana perjalanan: [{day, slots:[{time, activity}]}]');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
