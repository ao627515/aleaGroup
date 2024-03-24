<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'event_id'];

    public function members(){
        return $this->belongsToMany(Participant::class, 'group_members', 'group_id', 'participant_id', 'id', 'id');
    }

    public function event(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function membersCount(){
        return count($this->members);
    }
}
