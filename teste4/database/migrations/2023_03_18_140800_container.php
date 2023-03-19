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
        Schema::create('container', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('numero_container');
            $table->enum('tipo', ['20', '40']);
            $table->enum('status', ['Cheio', 'Vazio']);
            $table->enum('categoria', ['Importação', 'Exportação']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container');
    }
};
