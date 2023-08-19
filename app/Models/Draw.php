<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    use HasFactory;

    protected $table = 'draws';

    protected $fillable = [
        'grupo_id',
        'nome',
        'quantidade_premios',
        'data_expiracao',
        'status',
    ];

    // Relacionamento: Um sorteio pertence a um grupo de sorteios
    public function drawGroup()
    {
        return $this->belongsTo(DrawGroup::class, 'grupo_id');
    }

    // Relacionamento: Um sorteio pode ter vários prêmios
    public function prizes()
    {
        return $this->hasMany(Prize::class, 'sorteio_id');
    }

    // Relacionamento: Um sorteio pode ter vários participantes
    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'participant_draws');
    }

    // Relacionamento: Um sorteio pode ter vários ganhadores
    public function winners()
    {
        return $this->hasMany(Winner::class, 'sorteio_id');
    }
    //conta o número total de prêmios associados a um sorteio usando o relacionamento prizes() e, em seguida, atualiza o valor do campo quantidade_premios no próprio modelo Draw.
    public function updateTotalPrizes()
    {
        $totalPrizes = $this->prizes()->count();
        $this->update(['quantidade_premios' => $totalPrizes]);
    }
}
