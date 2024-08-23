<?php

namespace App\Models\Workplaces;

use App\Models\Events\Event;
use App\Models\Users\User;
use App\Models\Users\User_workplace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Workplace extends Model
{
    use SoftDeletes, CascadesDeletes;

    public $timestamps = true;

    protected $table = "workplaces";

    protected $fillable = [
        'name',
        'address'
    ];

    //? Preguntar si quitar 'user_worplaces'
    protected $cascadeDeletes = ['user_workplaces', 'event'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workplaces')->whereNull('user_workplaces.deleted_at');
    }

    public function user_workplaces()
    {
        return $this->hasMany(User_workplace::class, 'workplace_id', 'id');
    }

    public function getUsersData($key)
    {
        return $this->users->pluck($key)->toArray();
    }

    public function event()
    {
        return $this->hasMany(Event::class, 'workplace_id', 'id');
    }

    public function getJsonData()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'users' => $this->getUsersData('uuid')
        ];
    }
}
