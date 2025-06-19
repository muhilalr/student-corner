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
        Schema::table('hasil_kuis_regulers', function (Blueprint $table) {
            $table->integer('jawaban_benar')->nullable()->after('skor');
            $table->integer('jawaban_salah')->nullable()->after('jawaban_benar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_kuis_regulers', function (Blueprint $table) {
            $table->dropColumn(['jawaban_benar', 'jawaban_salah']);
        });
    }
};
