<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function createdBy(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function participation(){
        return $this->belongsToMany(Participant::class, 'participations', 'event_id', 'participant_id', 'id', 'id');
    }


    public function participantCount(){
        return $this->participation()->count();
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

    static public function count(){
        return Event::where('user_id', auth()->user()->id)->count();
    }

    public function getName()
    {
        return ucwords($this->name);
    }

    public function getCreated_at(string $format = 'd-m-Y')
    {
        return date($format, strtotime($this->created_at));
    }
}
