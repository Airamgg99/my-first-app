<?php

namespace App\Models\Users;

use App\Models\Jobs\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_job extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = "user_jobs";

    protected $fillable = [
        'user_id',
        'job_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
}
