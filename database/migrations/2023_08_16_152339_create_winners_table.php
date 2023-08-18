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
        Schema::create('winners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sorteio_id'); // Chave estrangeira para o sorteio
            $table->unsignedBigInteger('premio_id'); // Chave estrangeira para o prêmio
            $table->unsignedBigInteger('participante_id'); // Chave estrangeira para o participante
            $table->timestamps(); // Colunas para timestamps de criação e atualização

            // Chaves estrangeiras para as tabelas "draws", "prizes" e "participants"
            $table->foreign('sorteio_id')->references('id')->on('draws')->cascadeOnDelete();
            $table->foreign('premio_id')->references('id')->on('prizes')->cascadeOnDelete();
            $table->foreign('participante_id')->references('id')->on('participants')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('winners');
    }
};
