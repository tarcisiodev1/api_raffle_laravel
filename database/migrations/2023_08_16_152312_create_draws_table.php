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
        Schema::create('draws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupo_id'); // Coluna para a chave estrangeira do grupo de sorteios
            $table->string('nome'); // Coluna para o nome do sorteio
            $table->integer('quantidade_premios'); // Coluna para a quantidade de prêmios
            $table->date('data_expiracao'); // Coluna para a data de expiração do sorteio
            $table->boolean('status')->default(true); // Coluna para o status do sorteio
            $table->timestamps(); // Colunas para timestamps de criação e atualização

            // Chave estrangeira para a tabela "draw_groups"
            $table->foreign('grupo_id')->references('id')->on('draw_groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draws');
    }
};
