<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Participant::class);

        $data['page_title'] = 'Gestion des participants';
        $data['header_title'] = 'Gestion des participants';
        $data['records'] = Participant::getRecords(search: true, filter: true, paginate: 15);

        return view('participants.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Participant::class);

        $data = request()->validate([
            'f_create_name' => ['required', 'string', 'max:255'],
        ], [
            'f_create_name.required' => 'Veuillez entrer au moins un caractère pour le nom du participant.',
            'f_create_name.string' => 'Le nom d\'un participant doit être une chaîne de caractères.',
            'f_create_name.max' => 'Le nom d\'un participant ne doit pas dépasser :max caractères.',
        ]);

        Participant::create([
            'name' => strtolower($data['f_create_name']),
            'user_id' => auth()->user()->id
        ]);

        return to_route('participant.index')->with('success', 'Participant créé !');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        $this->authorize('update', $participant);

        $data = request()->validate([
            'f_update_name' => ['required', 'string', 'max:255']
        ], [
            'f_update_name.required' => 'Veuillez entrer au moins un caractère pour le nom du participant.',
            'f_update_name.string' => 'Le nom d\'un participant doit être une chaîne de caractères.',
            'f_update_name.max' => 'Le nom d\'un participant ne doit pas dépasser :max caractères.',
        ]);

        $participant->update([
            'name' => strtolower($data['f_update_name'])
        ]);

        return to_route('participant.index')->with('success', 'Modification réussie !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        $this->authorize('delete', $participant);

        $participant->delete();

        return to_route('participant.index')->with('success', 'Suppression réussie !');
    }
}
