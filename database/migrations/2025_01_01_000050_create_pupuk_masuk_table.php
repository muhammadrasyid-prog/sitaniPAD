<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pupuk_masuk', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_pupuk');
            $table->string('satuan');
            $table->decimal('kuantitas', 10, 2);
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total_harga', 15, 2);
            $table->string('supplier')->nullable();
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
        Schema::dropIfExists('pupuk_masuk');
    }
};
