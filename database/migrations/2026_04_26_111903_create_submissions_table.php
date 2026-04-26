<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke Mahasiswa (NIM)
            $table->string('nama_kegiatan');
            $table->string('jenis_surat');
            $table->date('tanggal_pengajuan');
            $table->text('keterangan')->nullable();
            $table->string('file_path');
            $table->string('status')->default('Diajukan'); // Diajukan, Disetujui, Revisi
            $table->text('revision_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
