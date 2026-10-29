<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kepentingan_umum', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kategori_kegiatan');
            $table->text('deskripsi');
            $table->decimal('jumlah', 15, 2);
            $table->json('bukti_foto')->nullable();
            $table->boolean('tampil_di_landing')->default(false);
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kepentingan_umum');
    }
};
