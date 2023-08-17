<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    protected $table = 'churches';

    protected $fillable = [
        'nome',
        'endereco',
    ];

    // Relacionamento: Uma igreja pode ter vários grupos de sorteios
    public function drawGroups()
    {
        return $this->hasMany(DrawGroup::class, 'igreja_id');
    }
}
