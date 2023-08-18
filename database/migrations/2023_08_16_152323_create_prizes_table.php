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
        Schema::create('prizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sorteio_id'); // Chave estrangeira para o sorteio
            $table->string('nome'); // Coluna para o nome do prêmio
            $table->timestamps(); // Colunas para timestamps de criação e atualização

            // Chave estrangeira para a tabela "draws"
            $table->foreign('sorteio_id')->references('id')->on('draws')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prizes');
    }
};
