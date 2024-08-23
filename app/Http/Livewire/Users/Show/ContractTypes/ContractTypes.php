<?php

namespace App\Http\Livewire\Users\Show\ContractTypes;

use App\Models\ContractTypes\ContractType;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ContractTypes extends Component
{
    use WithPagination, LivewireAlert;

    public $searchTerm;
    public $user;
    public $showUnlinkedContract = false;

    public function render()
    {
        $searchTerm = $this->searchTerm;

        $contract_types = ContractType::where('name', 'LIKE', "%{$searchTerm}%")
            ->whereHas('users', function ($q) {
                $q->where('users.id', $this->user->id);
            })
            ->paginate(5);

        return view('users.tabs.contract_types.contract_type', ['contract_types' => $contract_types, 'showUnlinkedContract' => $this->showUnlinkedContract]);
    }

    public function toggleUnlinkedContractTypes()
    {
        $this->showUnlinkedContract = !$this->showUnlinkedContract;
    }

    public function unlink($id)
    {
        $contract_type = ContractType::find($id);
        if ($contract_type) {
            $this->user->contract_types()->detach($contract_type);

            $this->alert('success', 'Contract type unlinked successfully.');
            $this->resetPage();
        } else {
            $this->alert('error', 'Contract type not found.');
        }
    }
}
