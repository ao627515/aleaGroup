<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

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
        return view('events.show', $event);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Event $event)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
