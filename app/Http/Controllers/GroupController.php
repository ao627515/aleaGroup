<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Event;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function generate(Event $event)
    {
        $groupsCount = request('groups', 0);
        $membersCount = request('members', 0);
        $participants = $event->participants()->pluck('participants.id')->toArray();

        request()->validateWithBag('groupsGenerateErrors', [
            'groups' => ['required', 'integer', 'max:' . count($participants)],
            'members' => ['required', 'integer', 'max:' . (count($participants) - 1)],
        ],[
            'groups.required' => 'Le nombre de groupes est requis.',
            'groups.integer' => 'Le nombre de groupes doit être un entier.',
            'groups.max' => 'Le nombre de groupes ne peut pas dépasser :max.',
            'members.required' => 'Le nombre de membres par groupe est requis.',
            'members.integer' => 'Le nombre de membres par groupe doit être un entier.',
            'members.max' => 'Le nombre de membres par groupe ne peut pas dépasser :max.',
        ]);


        // les 2 parametre ne doivent pas etre vide
        if($groupsCount == 0 && $membersCount == 0){
            return back()->withErrors(['groupsGenerateErrors' => 'Veuillez entrer au moins 1 paramètre.']);
        }

        // le nomnbre minimum de group est de 2
        if($groupsCount == 1){
            return back()->withErrors(['groupsGenerateErrors' => 'Il n\'est pas permit de creer un seul groupe 🤦‍♂️.']);
        }

        // dd($membersCount);

        if($membersCount > 0){
            $nbGroupCreable = intdiv(count($participants), $membersCount);
            $nbGroupCreableWithOverflow = count($participants) % $membersCount != 0 ? $nbGroupCreable + 1 : $nbGroupCreable;

            // on peut pas creer des groupe vide
            if($groupsCount > $nbGroupCreableWithOverflow){
                return back()->withErrors(['groupsGenerateErrors' => 'On ne peut creer autant de groupe avec ce nombre de participant.']);
            }
        }


        // traitements

        shuffle($participants);

        if(!empty($event->groups)){
            $this->deleteGroups($event);
        }

        // si on donne uniquement le nombre de membres
        if($groupsCount == 0 && $membersCount > 0){
            $this->generateGroupWtithMembers($nbGroupCreableWithOverflow, $membersCount, $participants, $event);
            // dd($groupsCount);
        }

        if($groupsCount > 0){
            $nbMemberByGroup = intdiv(count($participants), $groupsCount);
            $nbMemberByGroupWithOverflow = count($participants) % $groupsCount != 0 ? $nbMemberByGroup + 1 : $nbMemberByGroup;
        }

        // si on donne uniquement le nombre de groupes
        if($groupsCount !== 0 && $membersCount == 0){
            $this->generateGroupWtithGroups($nbMemberByGroupWithOverflow, $groupsCount, $participants, $event);
        }

        // si on les 2 parametre groupes min 2 et membres min 1
        if($groupsCount > 1 && $membersCount > 0){
            $this->generateGroupWtithGroupsAndMembers($groupsCount, $membersCount, $participants, $event);
        }

        return to_route('event.show.groups', $event);
    }

    private function deleteGroups(Event $event){
        $event->groups->each(function ($item, $key) {
            $item->delete();
        });
    }


    private function generateGroupWtithMembers($nbGroupCreableWithOverflow, $membersCount, $participants, $event) {
        for ($i = 0; $i < $nbGroupCreableWithOverflow; $i++) {

            $group = Group::create(['number' => $i + 1, 'event_id' => $event->id]);

            $members = array_slice($participants, 0, $membersCount);
            $group->members()->sync($members);

            $participants = array_diff($participants, $members);

            shuffle($participants);
        }
    }

    private function generateGroupWtithGroups($nbMemberByGroupWithOverflow, $groupsCount, $participants, $event) {
        for ($i = 0; $i < $groupsCount; $i++) {

            $group = new Group(['number' => $i + 1, 'event_id' => $event->id]);
            $group->save();

            $members = array_slice($participants, 0, $nbMemberByGroupWithOverflow);
            $group->members()->sync($members);

            $participants = array_diff($participants, $members);

            shuffle($participants);
        }
    }

    private function generateGroupWtithGroupsAndMembers($groupsCount, $membersCount, $participants, $event) {
        for ($i = 0; $i < $groupsCount; $i++) {

            $group = new Group(['number' => $i + 1, 'event_id' => $event->id]);
            $group->save();

            $members = array_slice($participants, 0, $membersCount);
            $group->members()->sync($members);

            $participants = array_diff($participants, $members);

            shuffle($participants);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}
