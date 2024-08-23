<?php

namespace App\Models\ContractTypes;

use App\Models\Users\User;
use App\Models\Users\User_contract_type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractType extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $table = "contract_types";

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_contract_types')->whereNull('user_contract_types.deleted_at');
    }

    public function user_contract_types()
    {
        return $this->hasMany(User_contract_type::class, 'contract_type_id', 'id');
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
