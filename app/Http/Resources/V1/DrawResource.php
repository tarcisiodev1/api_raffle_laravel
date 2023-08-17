<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DrawResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'grupo_id' => $this->grupo_id,
            'nome' => $this->nome,
            'quantidade_premios' => $this->quantidade_premios,
            'data_expiracao' => $this->data_expiracao,
            'status' => $this->status,
        ];
    }
}
