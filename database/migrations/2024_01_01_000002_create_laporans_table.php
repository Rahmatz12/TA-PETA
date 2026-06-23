<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nama_pelapor');
            $table->string('telepon');
            $table->string('email')->nullable();
            $table->enum('status_pelapor', ['masyarakat', 'petani', 'petugas', 'pemerintah', 'lainnya'])->default('masyarakat');
            $table->string('nama_saluran');
            $table->enum('jenis_saluran', ['primer', 'sekunder', 'tersier', 'pintu', 'bendungan']);
            $table->string('kecamatan');
            $table->string('desa')->nullable();
            $table->string('alamat')->nullable();
            $table->text('deskripsi_lokasi')->nullable();
            $table->text('jenis_kerusakan');
            $table->enum('tingkat_keparahan', ['ringan', 'sedang', 'berat', 'kritis']);
            $table->enum('dampak_pertanian', ['tidak-ada', 'ringan', 'sedang', 'berat', 'sangat-berat'])->nullable();
            $table->enum('lama_kerusakan', ['baru', '1-7', '7-30', 'lebih-1', 'tidak-tahu'])->nullable();
            $table->text('deskripsi_kerusakan');
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->enum('status', ['menunggu', 'diverifikasi', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('catatan_verifikasi')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->timestamp('tanggal_proses')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->string('estimasi_perbaikan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
