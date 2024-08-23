<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContractTypes\ContractType;
use App\Models\Users\User_contract_type;
use App\Models\Users\User_workplace;
use App\Models\Workplaces\Workplace;

class DashboardController extends Controller
{
    public function getWorkplaces()
    {
        $workplaces = [];
        $users_workplaces = [];

        foreach (Workplace::all() as $workplace) {
            $workplaces[] = $workplace->name;
            $users_workplaces[] = User_workplace::where('workplace_id', $workplace->id)->count();
        }

        $series = [
            [
                'name' => 'Workers',
                'data' => $users_workplaces
            ]
        ];

        return ['labels' => $workplaces, 'series' => $series];
    }

    public function getContractTypes()
    {
        $contract_types = [];
        $user_contract_types = [];

        foreach (ContractType::all() as $contract_type) {
            $contract_types[] = $contract_type->name;
            $user_contract_types[] = User_contract_type::where('contract_type_id', $contract_type->id)->count();
        }

        $series = [
            [
                'name' => 'Contract Types',
                'data' => $user_contract_types
            ]
        ];

        return ['labels' => $contract_types, 'series' => $series];
    }
}
