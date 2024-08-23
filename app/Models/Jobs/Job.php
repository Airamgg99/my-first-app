<?php

namespace App\Models\Jobs;

use App\Models\Users\User;
use App\Models\Users\User_job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $table = "jobs";

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_jobs')->whereNull('user_jobs.deleted_at');
    }

    public function user_jobs()
    {
        return $this->hasMany(User_job::class, 'job_id', 'id');
    }

    public function getUsersData($key)
    {
        return $this->users->pluck($key)->toArray();
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
