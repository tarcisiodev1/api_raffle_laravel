<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    protected $table = 'prizes';

    protected $fillable = [
        'sorteio_id',
        'nome',
    ];

    // Relacionamento: Um prêmio pertence a um sorteio
    public function draw()
    {
        return $this->belongsTo(Draw::class, 'sorteio_id');
    }

    // Relacionamento: Um prêmio pode ter vários ganhadores
    public function winners()
    {
        return $this->hasMany(Winner::class, 'premio_id');
    }
}
