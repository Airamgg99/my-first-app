<?php

namespace App\Models\Events;

use App\Models\Users\User;
use App\Models\Workplaces\Workplace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes, CascadesDeletes;

    protected $fillable = [
        'title',
        'date',
        'startDate',
        'start',
        'endDate',
        'end',
        'user_id',
        'workplace_id',
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
