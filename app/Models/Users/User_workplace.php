<?php

namespace App\Models\Users;

use App\Models\Workplaces\Workplace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class User_workplace extends Model
{
    use SoftDeletes, CascadesDeletes;

    public $timestamps = true;

    protected $table = "user_workplaces";

    protected $fillable = [
        'user_id',
        'workplace_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function workplace()
    {
        return $this->belongsTo(Workplace::class, 'workplace_id', 'id');
    }
}
