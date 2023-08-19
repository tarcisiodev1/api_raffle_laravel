<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantDraw extends Model
{
    use HasFactory;

    protected $table = 'participant_draws'; // Defina o nome da tabela pivot

    protected $fillable = [
        'participant_id', // Coluna para a chave estrangeira do participante
        'draw_id', // Coluna para a chave estrangeira do sorteio
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class); // Relacionamento com a tabela de participantes
    }

    public function draw()
    {
        return $this->belongsTo(Draw::class); // Relacionamento com a tabela de sorteios
    }
}
