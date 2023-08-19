<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\WinnerResource;
use App\Models\Draw;
use App\Models\Winner;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class DrawExecutionController extends Controller
{
    use HttpResponses; // Use a trait para as respostas HTTP

    public function index(Draw $draw)
    {
        // Verifica se o sorteio está ativo e se ainda não expirou
        if ($draw->status && now() < $draw->data_expiracao) {
            // Obtém todos os participantes associados a este sorteio
            $participants = $draw->participants;

            // Verifica se há participantes para este sorteio
            if ($participants->isEmpty()) {
                return $this->error('No participants found for this draw. Cannot execute draw.', 400);
            }

            // Verifica se há prêmios no sorteio
            $prizes = $draw->prizes;
            if ($prizes->isEmpty()) {
                return $this->error('No prizes found for this draw. Cannot execute draw.', 400);
            }

            $winnersData = [];

            // Para cada prêmio no sorteio
            foreach ($prizes as $prize) {
                // Verifica se ainda há participantes para este prêmio
                if ($participants->isEmpty()) {
                    break; // Não há mais participantes, interrompe o loop de prêmios
                }

                // Seleciona um participante aleatório como ganhador
                $winner = $participants->random();
                $winnerParticipant = Winner::create([
                    'sorteio_id' => $draw->id,
                    'premio_id' => $prize->id,
                    'participante_id' => $winner->id,
                ]);

                // Remove o participante selecionado da lista
                $participants = $participants->reject(function ($participant) use ($winner) {
                    return $participant->id === $winner->id;
                });

                // Cria uma instância do resource WinnerResource para formatar os dados do ganhador
                $winnerResource = new WinnerResource($winnerParticipant);

                // Adiciona os dados do ganhador formatados ao array de dados
                $winnersData[] = [
                    'prize' => $prize,
                    'winner' => $winnerResource,
                ];
            }

            // Modifica o status do sorteio para "inativo"
            $draw->update(['status' => false]);

            return $this->response('Draw executed successfully', 200, ['winners' => $winnersData]);
        }

        return $this->error('Cannot execute draw at the moment', 400);
    }
}
