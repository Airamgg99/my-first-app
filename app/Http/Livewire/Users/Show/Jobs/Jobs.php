<?php

namespace App\Http\Livewire\Users\Show\Jobs;

use App\Models\Jobs\Job;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Jobs extends Component
{
    use WithPagination, LivewireAlert;

    public $searchTerm;
    public $user;
    public $showUnlinkedJob = false;

    public function render()
    {
        $searchTerm = $this->searchTerm;

        $jobs = Job::where('name', 'LIKE', "%{$searchTerm}%")
            ->whereHas('users', function ($q) {
                $q->where('users.id', $this->user->id);
            })
            ->paginate(5);

        return view('users.tabs.jobs.job', ['jobs' => $jobs, 'showUnlinkedJob' => $this->showUnlinkedJob]);
    }

    public function toggleUnlinkedJobs()
    {
        $this->showUnlinkedJob = !$this->showUnlinkedJob;
    }

    public function unlink($id)
    {
        $job = Job::find($id);
        if ($job) {
            $this->user->jobs()->detach($job);

            $this->alert('success', 'Job unlinked successfully.');
            $this->resetPage();
        } else {
            $this->alert('error', 'Job not found.');
        }
    }
}
