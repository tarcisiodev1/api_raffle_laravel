<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrawGroup extends Model
{
    use HasFactory;

    protected $table = 'draw_groups';


    protected $fillable = [
        'igreja_id',
        'nome',
    ];

    // Relacionamento: Um grupo de sorteios pertence a uma igreja
    public function church()
    {
        return $this->belongsTo(Church::class, 'igreja_id');
    }

    // Relacionamento: Um grupo de sorteios pode ter vários sorteios
    public function draws()
    {
        return $this->hasMany(Draw::class, 'grupo_id');
    }
}
