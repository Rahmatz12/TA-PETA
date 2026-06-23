<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salurans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis', ['primer', 'sekunder', 'tersier', 'pintu', 'bendungan']);
            $table->string('kecamatan');
            $table->string('desa')->nullable();
            $table->string('alamat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('kondisi', ['baik', 'perbaikan', 'rusak-ringan', 'rusak-sedang', 'rusak-berat'])->default('baik');
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->string('level_air')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salurans');
    }
};
