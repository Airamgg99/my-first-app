<?php

namespace App\Http\Livewire\Users\Show\Workplaces;

use App\Models\Workplaces\Workplace;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class UnlinkedWorkplaces extends Component
{
    use WithPagination, LivewireAlert;

    public $searchTerm;
    public $user;
    public $showUnlinkedWorkplace = false;

    public function render()
    {
        $searchTerm = $this->searchTerm;

        $unlinkedWorkplaces = Workplace::where('name', 'LIKE', "%{$searchTerm}%")
            ->whereDoesntHave('users', function ($q) {
                $q->where('users.id', $this->user->id);
            })
            ->paginate(5);

        return view('users.tabs.workplaces.unlinked_workplaces', ['unlinkedWorkplaces' => $unlinkedWorkplaces]);
    }

    public function toggleUnlinkedWorkplaces()
    {
        $this->showUnlinkedWorkplace = !$this->showUnlinkedWorkplace;
    }

    public function link($id)
    {
        $workplace = Workplace::find($id);
        $this->user->workplaces()->attach($workplace);

        $this->alert('success', 'Workplace added successfully.');
        $this->resetPage();
    }
}
