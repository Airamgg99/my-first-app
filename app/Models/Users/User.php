<?php

namespace App\Models\Users;

use App\Models\ContractTypes\ContractType;
use App\Models\Events\Event;
use App\Models\Jobs\Job;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles\Role;
use App\Models\Statuses\Status;
use App\Models\Workplaces\Workplace;
use Illuminate\Support\Facades\Storage;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory,  Notifiable, SoftDeletes, CascadesDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'token',
        'status_id',
        'role_id'
    ];

    // TODO Preguntar si es correcto haber borrado 'user_workplaces'
    protected $cascadeDeletes = ['user_workplaces', 'user_contract_types', 'user_jobs', 'events'];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function workplaces()
    {
        return $this->belongsToMany(Workplace::class, 'user_workplaces');
    }

    public function user_workplaces()
    {
        return $this->hasMany(User_workplace::class, 'user_id', 'id');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'user_jobs');
    }

    public function user_jobs()
    {
        return $this->hasMany(User_job::class, 'user_id', 'id');
    }

    public function contract_types()
    {
        return $this->belongsToMany(ContractType::class, 'user_contract_types');
    }

    public function user_contract_types()
    {
        return $this->hasMany(User_contract_type::class, 'user_id', 'id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'user_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->uuid)) {
                $user->uuid = Str::uuid()->toString();
            }
        });
    }

    public function existImage()
    {
        return Storage::disk('users')->exists($this->image);
    }

    public function getImage()
    {
        if ($this->existImage()) {
            return 'data:image/png;base64,' . base64_encode(Storage::disk('users')->get($this->image));
        } else {
            return 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('/images/notFound.png')));
        }
    }

    public function setPasswordAttribute($value)
    {
        if ($value != null) {
            $this->attributes['password'] = trim(bcrypt($value));
        }
    }

    public function getJsonData()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'image' => $this->image
        ];
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at'
    ];
}
