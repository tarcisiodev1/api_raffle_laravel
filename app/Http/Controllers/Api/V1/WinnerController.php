<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\WinnerResource;
use App\Models\Draw;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class WinnerController extends Controller
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

        // Retornar a lista de ganhadores para o sorteio
        $winners = $draw->winners;

        return $this->response('List of Winners', 200, WinnerResource::collection($winners));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
