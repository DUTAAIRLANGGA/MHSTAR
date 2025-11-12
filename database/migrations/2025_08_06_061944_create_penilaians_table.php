<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('penilaians', function (Blueprint $table) {
    $table->id();
    $table->foreignId('id_siswa')->constrained('siswas');
    $table->integer('kehadiran');
    $table->integer('kedisiplinan');
    $table->integer('nilai_raport');
    $table->integer('kerja_sama_tim');
    $table->integer('kreativitas');
    $table->integer('inisiatif');
$table->decimal('total_nilai', 6, 2)->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaians');
    }
};
