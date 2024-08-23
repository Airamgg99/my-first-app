<?php

namespace App\Http\Livewire\Users\Show\Workplaces;

use App\Models\Workplaces\Workplace;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Workplaces extends Component
{
    use WithPagination, LivewireAlert;

    public $searchTerm;
    public $user;
    public $showUnlinkedWorkplace = false;

    public function render()
    {
        $searchTerm = $this->searchTerm;

        $workplaces = Workplace::where('name', 'LIKE', "%{$searchTerm}%")
            ->whereHas('users', function ($q) {
                $q->where('users.id', $this->user->id);
            })
            ->paginate(5);

        return view('users.tabs.workplaces.workplace', ['workplaces' => $workplaces, 'showUnlinkedWorkplace' => $this->showUnlinkedWorkplace]);
    }

    public function toggleUnlinkedWorkplaces()
    {
        $this->showUnlinkedWorkplace = !$this->showUnlinkedWorkplace;
    }

    public function unlink($id)
    {
        $workplace = Workplace::find($id);
        if ($workplace) {
            $this->user->workplaces()->detach($workplace);

            $this->alert('success', 'Workplace unlinked successfully.');
            $this->resetPage();
        } else {
            $this->alert('error', 'Workplace not found.');
        }
    }
}
