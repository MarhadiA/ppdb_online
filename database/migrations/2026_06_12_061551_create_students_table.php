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
     Schema::create('students', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    // Data diri
    $table->string('nik')->unique();
    $table->string('nama_lengkap');
    $table->string('tempat_lahir');
    $table->date('tanggal_lahir');
    $table->enum('jenis_kelamin', ['L', 'P']);
    $table->string('agama');
    $table->text('alamat');
    $table->string('no_hp');

    // Data orang tua
    $table->string('nama_ayah');
    $table->string('nama_ibu');
    $table->string('pekerjaan_ortu');

    // Data akademik
    $table->string('sekolah_asal');
    $table->decimal('nilai_rata_rata', 5, 2);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
