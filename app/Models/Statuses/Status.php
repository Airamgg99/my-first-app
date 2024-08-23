<?php

namespace App\Models\Statuses;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
