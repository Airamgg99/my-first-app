<?php

namespace App\Http\Livewire\Users;

use App\Models\Roles\Role;
use App\Models\Statuses\Status;
use App\Models\Users\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Table extends Component
{
    use LivewireAlert;

    public $search = '';
    public $searchTerm = '';
    public $role_id;
    public $status_id;
    public $showDeleted = false;
    public $selected_user;

    public function setId($id)
    {
        $this->selected_user = User::withTrashed()->find($id);
    }

    public function delete()
    {
        if ($this->selected_user) {
            $this->selected_user->delete();
            $this->selected_user = null;
            $this->alert('success', 'User deleted successfully.');
        }
    }

    public function restore($id)
    {
        $this->selected_user = User::withTrashed()->find($id);
        if ($this->selected_user) {
            $this->selected_user->restore();
            $this->alert('success', 'User restored successfully.');
        }
    }

    public function forceDelete($id)
    {
        $this->selected_user = User::withTrashed()->find($id);
        if ($this->selected_user) {
            $this->selected_user->forceDelete();
            $this->alert('success', 'User deleted permanently.');
        }
    }

    public function download()
    {
        return app('App\Http\Controllers\Admin\AdminController')->download();
    }

    public function render()
    {
        $searchValue = !empty($this->searchTerm) ? $this->searchTerm : $this->search;

        $usersQuery = User::with(['role', 'status'])
            ->when($this->status_id, function ($query) {
                $query->where('status_id', $this->status_id);
            })
            ->when($this->role_id, function ($query) {
                $query->where('role_id', $this->role_id);
            })
            ->when($searchValue, function ($query) use ($searchValue) {
                $query->where(function ($query) use ($searchValue) {
                    $query->where('name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                });
            });

        if ($this->showDeleted) {
            $usersQuery->onlyTrashed();
        }

        $users = $usersQuery->get();
        $roles = Role::all();
        $statuses = Status::all();
        return view('users.table', ['users' => $users, 'roles' => $roles, 'statuses' => $statuses]);
    }
}
