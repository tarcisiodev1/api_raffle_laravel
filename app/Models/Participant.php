<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = 'participants';

    protected $fillable = [
        'sorteio_id',
        'nome',
        'quantidade_bilhetes',
    ];


    public function draw()
    {
        // Define a relação many-to-many com o modelo Draw
        // usando a tabela intermediária 'participant_draws'
        return $this->belongsToMany(Draw::class, 'participant_draws');
    }

    // Relacionamento: Um participante pode ser um ganhador de um prêmio
    public function winners()
    {
        return $this->hasMany(Winner::class, 'participante_id');
    }
}
