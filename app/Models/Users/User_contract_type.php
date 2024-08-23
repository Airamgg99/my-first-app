<?php

namespace App\Models\Users;

use App\Models\ContractTypes\ContractType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_contract_type extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = "user_contract_types";

    protected $fillable = [
        'user_id',
        'contract_type_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contract_type()
    {
        return $this->belongsTo(ContractType::class, 'contract_type_id', 'id');
    }
}
