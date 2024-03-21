<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function createdBy(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function participants(){
        return $this->belongsToMany(Participant::class, 'participations', 'event_id', 'participant_id', 'id', 'id');
    }

    public function groups(){
        return $this->hasMany(Group::class, 'event_id', 'id');
    }

    public function groupsCount(){
        return $this->groups()->count();
    }

    public function participantsCount(){
        return $this->participants()->count();
    }

    public function participantsInGroupsCount(){
        $count = 0;
        foreach($this->groups as $group){
            $count += $group->membersCount();
        }
        return $count;
    }

    public function participantsInNotGroupsCount(){
        return $this->participantsCount() - $this->participantsInGroupsCount();
    }

    static public function getRecords(bool $search = false, bool $filter = false, int $paginate = 0, string $order = 'desc')
    {

        $query = Event::orderBy('created_at', $order)->where('user_id', auth()->user()->id);

        if ($search) {
            $query = Event::search($query);
        }

        if ($filter) {
            $query = Event::filter($query);
        }

        if ($paginate) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

    static private function search(Builder $query)
    {
        request()->validate([
            'f_search_name' => ['nullable', 'string', 'max:255'],
        ]);

        return $query->when(request()->filled('f_search_name'), function ($q) {
            $q->where('name', 'like', '%' . request('f_search_name') . '%');
        });
    }

    static private function filter(Builder $query)
    {
        request()->validate([
            'f_filter_created_at' => ["nullable", "date"]
        ]);

        // filled verifie si un attribut dans la requete est present et non null (est filled ?)
        return $query->when(request()->filled('f_filter_created_at'), function ($q) {
                $q->whereDate('created_at', request('f_filter_created_at'));
            });
    }

     public function getParticipantsRecords(bool $search = false, bool $filter = false, int $paginate = 0, string $order = 'desc')
    {

        $query = $this->participants()->orderBy('created_at', $order);

        if ($search) {
            $query = Event::participantSearch($query);
        }

        if ($filter) {
            $query = Event::participantFilter($query);
        }

        if ($paginate) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

    static private function participantSearch(BelongsToMany $query)
    {
        request()->validate([
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        return $query->when(request()->filled('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        });
    }

    static private function participantFilter(BelongsToMany $query)
    {
        request()->validate([
            'f_filter_created_at' => ["nullable", "date"]
        ]);

        // filled verifie si un attribut dans la requete est present et non null (est filled ?)
        return $query->when(request()->filled('f_filter_created_at'), function ($q) {
                $q->whereDate('created_at', request('f_filter_created_at'));
            });
    }

    static public function count(){
        return Event::where('user_id', auth()->user()->id)->count();
    }

    public function getName()
    {
        return Str::ucfirst($this->name);
    }

    public function getCreated_at(string $format = 'd-m-Y')
    {
        return date($format, strtotime($this->created_at));
    }
}
