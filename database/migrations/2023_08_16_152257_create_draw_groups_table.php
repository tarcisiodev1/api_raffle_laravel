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
        Schema::create('draw_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('igreja_id'); // Coluna para a chave estrangeira da igreja
            $table->string('nome'); // Coluna para o nome do grupo de sorteios
            $table->timestamps(); // Colunas para timestamps de criação e atualização

            // Chave estrangeira para a tabela "churches"
            $table->foreign('igreja_id')->references('id')->on('churches')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draw_groups');
    }
};
