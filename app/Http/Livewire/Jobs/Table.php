<?php

namespace App\Http\Livewire\Jobs;

use App\Models\Jobs\Job;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Table extends Component
{
    use LivewireAlert;

    public $search;
    public $selected_job;

    public function setId($id)
    {
        $this->selected_job = Job::find($id);
    }

    public function delete()
    {
        if ($this->selected_job) {
            $this->selected_job->delete();
            $this->selected_job = null;
            $this->alert('success', 'Job deleted successfully');
        }
    }

    public function download()
    {
        return app('App\Http\Controllers\Job\JobController')->download();
    }

    public function render()
    {
        $search = $this->search;

        $jobs = Job::where('name', 'LIKE', "%$search%")
            ->get();

        return view('jobs.table', ['jobs' => $jobs]);
    }
}
