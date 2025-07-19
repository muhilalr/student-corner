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
        Schema::create('informasi_magangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bidang');
            $table->string('posisi');
            $table->integer('kebutuhan_orang');
            $table->text('deskripsi');
            $table->text('persyaratan');
            $table->text('benefit');
            $table->text('info_kontak');
            $table->enum('status', ['aktif', 'nonaktif'])->default('nonaktif');
            $table->string('slug_bidang')->unique();
            $table->string('slug_posisi')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_magangs');
    }
};
