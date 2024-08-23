<?php

namespace App\Http\Livewire\Workplaces;

use App\Models\Workplaces\Workplace;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Table extends Component
{
    use LivewireAlert;

    public $search = '';
    public $searchTerm = '';
    public $selected_workplace;

    public function setId($id)
    {
        $this->selected_workplace = Workplace::find($id);
    }

    public function delete()
    {
        if ($this->selected_workplace) {
            $this->selected_workplace->delete();
            $this->selected_workplace = null;
            $this->alert('success', 'Workplace deleted successfully');
        }
    }

    public function download()
    {
        return app('App\Http\Controllers\Workplace\WorkplaceController')->download();
    }

    public function render()
    {
        $searchValue = !empty($this->searchTerm) ? $this->searchTerm : $this->search;

        $workplaces = Workplace::where('name', 'LIKE', "%$searchValue%")
            ->orWhere('address', 'LIKE', "%$searchValue%")
            ->get();

        return view('workplaces.table', ['workplaces' => $workplaces]);
    }
}
