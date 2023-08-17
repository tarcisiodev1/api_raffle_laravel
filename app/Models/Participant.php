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

    // Relacionamento: Um participante pertence a um sorteio
    public function draw()
    {
        return $this->belongsTo(Draw::class, 'sorteio_id');
    }

    // Relacionamento: Um participante pode ser um ganhador de um prêmio
    public function winners()
    {
        return $this->hasMany(Winner::class, 'participante_id');
    }
}
