<?php

namespace App\Http\Livewire\ContractTypes;

use App\Models\ContractTypes\ContractType;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Table extends Component
{
    use LivewireAlert;

    public $search;
    public $selected_contract_type;

    public function setId($id)
    {
        $this->selected_contract_type = ContractType::find($id);
    }

    public function delete()
    {
        if ($this->selected_contract_type) {
            $this->selected_contract_type->delete();
            $this->selected_contract_type = null;
            $this->alert('success', 'Contract type deleted successfully');
        }
    }

    public function download()
    {
        return app('App\Http\Controllers\Contract_type\ContractTypeController')->download();
    }

    public function render()
    {
        $search = $this->search;

        $contract_types = ContractType::where('name', 'LIKE', "%$search%")
            ->get();

        return view('contract_types.table', ['contract_types' => $contract_types]);
    }
}
