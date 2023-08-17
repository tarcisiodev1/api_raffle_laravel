<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;

    protected $table = 'winners';

    protected $fillable = [
        'sorteio_id',
        'premio_id',
        'participante_id',
    ];

    // Relacionamento: Um ganhador pertence a um sorteio
    public function draw()
    {
        return $this->belongsTo(Draw::class, 'sorteio_id');
    }

    // Relacionamento: Um ganhador pertence a um prêmio
    public function prize()
    {
        return $this->belongsTo(Prize::class, 'premio_id');
    }

    // Relacionamento: Um ganhador pertence a um participante
    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participante_id');
    }
}
