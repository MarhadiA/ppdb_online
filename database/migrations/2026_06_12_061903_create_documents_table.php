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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();

            $table->enum('jenis_dokumen', [
                'foto',
                'kk',
                'ijazah',
                'rapor',
                'prestasi'
            ]);

            // Cloudinary
            $table->string('cloudinary_url');
            $table->string('cloudinary_public_id');

            // VERIFIKASI
            $table->enum('status_verifikasi', [
                'belum_upload',
                'menunggu_verifikasi',
                'disetujui',
                'ditolak'
            ])->default('belum_upload');

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
