<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ParticipantResource;
use App\Models\Draw;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\HttpResponses;

class ParticipantController extends Controller
{
    use HttpResponses;


    public function index()
    {
        $draws = Participant::all();
        return $this->response('List of Draws', 200, ParticipantResource::collection($draws));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $drawId)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'quantidade_bilhetes' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        // Verificar se o sorteio existe
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        // Crie o participante associado ao sorteio
        $participant = $draw->participants()->create($validator->validated());

        return $this->response('Participant created', 201, new ParticipantResource($participant));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $drawId, string $participantId)
    {
        // Verificar se o sorteio existe
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        // Encontre o participante dentro do sorteio
        $participant = $draw->participants()->find($participantId);

        if (!$participant) {
            return $this->error('Participant not found', 404);
        }

        return $this->response('Participant details', 200, new ParticipantResource($participant));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $drawId, string $participantId)
    {
        // Verificar se o sorteio existe
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        // Encontre o participante dentro do sorteio
        $participant = $draw->participants()->find($participantId);

        if (!$participant) {
            return $this->error('Participant not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'string',
            'quantidade_bilhetes' => 'integer',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $updated = $participant->update($validator->validated());

        if ($updated) {
            return $this->response('Participant updated', 200, new ParticipantResource($participant));
        }

        return $this->error('Participant not updated', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $drawId, string $participantId)
    {
        // Verificar se o sorteio existe
        $draw = Draw::find($drawId);

        if (!$draw) {
            return $this->error('Draw not found', 404);
        }

        // Encontre o participante dentro do sorteio
        $participant = $draw->participants()->find($participantId);

        if (!$participant) {
            return $this->error('Participant not found', 404);
        }

        $deleted = $participant->delete();

        if ($deleted) {
            return $this->response('Participant deleted', 200);
        }

        return $this->error('Participant not deleted', 400);
    }

    public function buyTickets(Request $request, string $participantId)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $participant = Participant::find($participantId);

        if (!$participant) {
            return $this->error('Participant not found', 404);
        }

        $quantity = $validator->validated()['quantity'];

        // Atualizar a quantidade de bilhetes do participante
        $participant->quantidade_bilhetes += $quantity;
        $participant->save();

        return $this->response("Tickets purchased successfully", 200, new ParticipantResource($participant));
    }
}
