<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getName()
    {
        return ucwords($this->name);
    }

    public function getPhone()
    {
        return  implode(' ', str_split($this->phone, 2));
    }

    public function getRole()
    {
        return $this->role == 'admin' ? 'Administrateur' : 'Utilisateur';
    }

    public function getCreated_at(string $format = 'd-m-Y')
    {
        return date($format, strtotime($this->created_at));
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    static public function getRecords(bool $search = false, bool $filter = false, int $paginate = 0, string $order = 'desc')
    {

        $query = User::orderBy('created_at', $order);

        if ($search) {
            $query = User::search($query);
        }

        if ($filter) {
            $query = User::filter($query);
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
            'f_search_phone' => ['nullable', 'numeric'],
        ]);

        $q_name = request()->filled('f_search_name') ? request('f_search_name') : null;
        $q_phone = request()->filled('f_search_phone') ? trim(request('f_search_phone')) : null;

        return $query->where(function ($q) use ($q_name, $q_phone) {
            $q->when($q_name, function ($q) use ($q_name) {
                $q->where('name', 'like', "%{$q_name}%");
            })
            ->when($q_phone, function ($q) use ($q_phone) {
                    $q->where('phone', 'like', "%{$q_phone}%");
                });
        });
    }

    static private function filter(Builder $query)
    {
        request()->validate([
            'f_search_role' => ['nullable', 'string', 'in:user,admin'],
            'f_search_created_at' => ["nullable", "date"]
        ]);

        // filled verifie si un attribut dans la requete est present et non null (est filled ?)
        return $query
            ->when(request()->filled('f_search_role'), function ($q) {
                $q->where('role', request('f_search_role'));
            })
            ->when(request()->filled('f_search_created_at'), function ($q) {
                $q->whereDate('created_at', request('f_search_created_at'));
            });
    }

    public function participants() {
        return $this->hasMany(Participant::class, 'user_id', 'id');
    }
}
