<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function createdBy(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    static public function getRecords(bool $search = false, bool $filter = false, int $paginate = 0, string $order = 'desc')
    {

        $query = Participant::orderBy('created_at', $order)->where('user_id', auth()->user()->id);

        if ($search) {
            $query = Participant::search($query);
        }

        if ($filter) {
            $query = Participant::filter($query);
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
        return Participant::where('user_id', auth()->user()->id)->count();
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
