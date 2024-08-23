<?php

namespace App\Http\Livewire\Users\Show\ContractTypes;

use App\Models\ContractTypes\ContractType;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class UnlinkedContractTypes extends Component
{
    use WithPagination, LivewireAlert;

    public $searchTerm;
    public $user;
    public $showUnlinkedContract = false;

    public function render()
    {
        $searchTerm = $this->searchTerm;

        $unlinkedContractType = ContractType::where('name', 'LIKE', "%{$searchTerm}%")
            ->whereDoesntHave('users', function ($q) {
                $q->where('users.id', $this->user->id);
            })
            ->paginate(5);

        return view('users.tabs.contract_types.unlinked_contract_type', ['unlinkedContractType' => $unlinkedContractType]);
    }

    public function toggleUnlinkedWorkplaces()
    {
        $this->showUnlinkedContract = !$this->showUnlinkedContract;
    }

    public function link($id)
    {
        $contract_type = ContractType::find($id);
        $this->user->contract_types()->attach($contract_type);

        $this->alert('success', 'Contract type added successfully.');
        $this->resetPage();
    }
}
