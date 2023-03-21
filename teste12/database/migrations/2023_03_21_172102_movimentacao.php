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
        Schema::create('movimentacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('container_id');
            $table->foreign('container_id')->references('id')->on('container');
            $table->enum('tipo',['Embarque','Descarga','Gate in','Gate out','Reposicionamento','Pesagem','Scanner']);
            $table->dateTime('hora_data_inicio');
            $table->dateTime('hora_data_fim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacao');
    }
};
