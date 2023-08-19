<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PrizeResource;
use App\Models\Draw;
use App\Models\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\HttpResponses;

class PrizeController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(string $drawId)
    {
        // Verificar se o sorteio existe
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        // Retornar a lista de prêmios para o sorteio
        $prizes = $draw->prizes;

        return $this->response('List of Prizes', 200, PrizeResource::collection($prizes));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $drawId)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        // Verificar se o sorteio existe
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        // Criar o prêmio associado ao sorteio
        $prize = $draw->prizes()->create($validator->validated());

        // Atualizar a quantidade total de prêmios no sorteio
        $draw->updateTotalPrizes();

        return $this->response('Prize created', 201, new PrizeResource($prize));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $drawId, string $prizeId)
    {
        // Verificar se o sorteio existe
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        // Encontrar o prêmio associado ao sorteio
        $prize = $draw->prizes()->find($prizeId);

        if (!$prize) {
            return $this->error('Prize not found', 404);
        }

        return $this->response('Prize details', 200, new PrizeResource($prize));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $drawId, string $prizeId)
    {
        // Verificar se o sorteio existe
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        // Encontrar o prêmio associado ao sorteio
        $prize = $draw->prizes()->find($prizeId);

        if (!$prize) {
            return $this->error('Prize not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'string',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $updated = $prize->update($validator->validated());

        if ($updated) {
            return $this->response('Prize updated', 200, new PrizeResource($prize));
        }

        return $this->error('Prize not updated', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $drawId, string $prizeId)
    {
        // Verificar se o sorteio existe
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        // Encontrar o prêmio associado ao sorteio
        $prize = $draw->prizes()->find($prizeId);

        if (!$prize) {
            return $this->error('Prize not found', 404);
        }

        $deleted = $prize->delete();

        if ($deleted) {
            // Atualize a quantidade total de prêmios no sorteio após excluir um prêmio
            $draw->updateTotalPrizes();

            return $this->response('Prize deleted', 200);
        }

        return $this->error('Prize not deleted', 400);
    }
}
