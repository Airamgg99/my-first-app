<?php

namespace App\Http\Livewire\Users\Show\Jobs;

use App\Models\Jobs\Job;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class UnlinkedJobs extends Component
{
    use WithPagination, LivewireAlert;

    public $searchTerm;
    public $user;
    public $showUnlinkedJob = false;

    public function render()
    {
        $searchTerm = $this->searchTerm;

        $unlinkedJobs = Job::where('name', 'LIKE', "%{$searchTerm}%")
            ->whereDoesntHave('users', function ($q) {
                $q->where('users.id', $this->user->id);
            })
            ->paginate(5);

        return view('users.tabs.jobs.unlinked_jobs', ['unlinkedJobs' => $unlinkedJobs]);
    }

    public function toggleUnlinkedJobs()
    {
        $this->showUnlinkedJob = !$this->showUnlinkedJob;
    }

    public function link($id)
    {
        $job = Job::find($id);
        $this->user->jobs()->attach($job);

        $this->alert('success', 'Job added successfully.');
        $this->resetPage();
    }
}
