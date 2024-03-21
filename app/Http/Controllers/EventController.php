<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Lstes des évènements';
        $data['header_title'] = 'Listes des évènements';
        $data['records'] = Event::getRecords(search: true, filter: true);

        return view('events.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Event::class);

        $data = request()->validate([
            'f_create_name' => ['required', 'string', 'max:255'],
        ], [
            'f_create_name.required' => 'Veuillez entrer au moins un caractère pour le nom du de l\'évènement.',
            'f_create_name.string' => 'Le nom d\'un évènement doit être une chaîne de caractères.',
            'f_create_name.max' => 'Le nom d\'un évènement ne doit pas dépasser :max caractères.',
        ]);

        $event = Event::create([
            'name' => strtolower($data['f_create_name']),
            'user_id' => auth()->user()->id
        ]);

        return to_route('event.show', $event)->with('success', 'Evènement créé !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        if($event->participantsCount() < 2){
            return to_route('event.show.participants', $event);
        }else{
            return to_route('event.show.groups', $event);
        }
    }

    private function showVar(array &$data, Event $event){
        $data['event'] = $event;
        $data['userParticipants'] = $event->createdBy->participants()->orderBy('created_at', 'desc')->get();
        $data['participantsRecords'] = $event->getParticipantsRecords(search: true);
    }

    public function groupsPage(Event $event)
    {

        $data['page_title'] = 'AléaGroup - '.$event->getName();
        $data['header_title'] = $event->getName();
        $data['records'] = $event->groups;

        $this->showVar($data,$event);
        return view('events.show.groups', $data);
    }

    public function participantsPage(Event $event)
    {
        $data['page_title'] = 'AléaGroup - '.$event->getName();;
        $data['header_title'] = $event->getName();
        $data['records'] = $event->getParticipantsRecords(search: true);
        $this->showVar($data,$event);
        return view('events.show.participants', $data);
    }

    public function addParticipants(Event $event)
    {
        $data = request()->validate([
            'participants' => ['required', 'array']
        ], [
            'participants.required' => 'Veuillez sélectionnée un participant pour l\'importé'
        ]);

        $event->participants()->sync($data['participants']);

        return to_route('event.show.participants', $event)->with('success', "Participant impoté !");
    }

    public function expelParticipants(Event $event)
    {
        $event->participants()->detach($event->id);

        return to_route('event.show.participants', $event)->with('success', "Participant expulsé !");
    }

    public function createAndAddParticipant(Event $event){
        $this->authorize('create', Participant::class);

        $data = request()->validate([
            'f_create_name' => ['required', 'string', 'max:255'],
        ], [
            'f_create_name.required' => 'Veuillez entrer au moins un caractère pour le nom du participant.',
            'f_create_name.string' => 'Le nom d\'un participant doit être une chaîne de caractères.',
            'f_create_name.max' => 'Le nom d\'un participant ne doit pas dépasser :max caractères.',
        ]);

        $p = Participant::create([
            'name' => strtolower($data['f_create_name']),
            'user_id' => auth()->user()->id
        ]);

        $event->participants()->attach($p->id);

        return to_route('event.show.participants', $event)->with('success', "Participant impoté !");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Event $event)
    {
        // $this->authorize('update', $event);

        $data = request()->validate([
            'f_update_event_name' => ['required', 'string', 'max:255']
        ], [
            'f_update_event_name.required' => 'Veuillez entrer au moins un caractère pour le nom de l\'évènement.',
            'f_update_event_name.string' => 'Le nom d\'un évènement doit être une chaîne de caractères.',
            'f_update_event_name.max' => 'Le nom d\'un évènement ne doit pas dépasser :max caractères.',
        ]);

        $event->update([
            'name' => strtolower($data['f_update_event_name'])
        ]);

        return back()->with('Mise à jours éffectuer !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return to_route('event.index')->with('success', 'Suppression réussie !');
    }
}
