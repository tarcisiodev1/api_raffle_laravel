<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Draw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\DrawResource;
use App\Http\Resources\V1\PrizeResource;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class DrawController extends Controller
{
    use HttpResponses; // Use a trait para as respostas HTTP

    public function index()
    {
        $draws = Draw::all();
        return $this->response('List of Draws', 200, DrawResource::collection($draws));
    }

    public function show(string $drawId)
    {
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        return $this->response('Draw details', 200, new DrawResource($draw));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grupo_id' => 'required|exists:draw_groups,id',
            'nome' => 'required|string',
            'quantidade_premios' => 'required|integer',
            'data_expiracao' => 'required|date',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $draw = Draw::create($validator->validated());

        return $this->response('Draw created', 201, new DrawResource($draw));
    }

    public function update(Request $request, string $drawId)
    {
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'grupo_id' => 'required|exists:draw_groups,id',
            'nome' => 'required|string',
            'quantidade_premios' => 'required|integer',
            'data_expiracao' => 'required|date',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $draw->update($validator->validated());

        return $this->response('Draw updated', 200, new DrawResource($draw));
    }

    public function destroy(string $drawId)
    {
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        $draw->delete();

        return $this->response('Draw deleted', 200);
    }

    public function showPrizes(string $drawId)
    {
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        $prizes = $draw->prizes;

        return $this->response('List of Prizes for Draw', 200, PrizeResource::collection($prizes));
    }
}
