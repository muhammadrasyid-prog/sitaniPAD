<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pupuk_terpakai', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pakai');
            $table->string('nama_pupuk');
            $table->string('satuan');
            $table->decimal('kuantitas', 10, 2);
            $table->string('lahan_blok')->nullable();
            $table->string('tujuan_aplikasi')->nullable();
            $table->string('bukti_foto');
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pupuk_terpakai');
    }
};
