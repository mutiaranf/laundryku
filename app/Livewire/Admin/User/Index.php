<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use App\Exports\UsersExport;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Maatwebsite\Excel\Facades\Excel;

#[Title('User Management')]
class Index extends Component
{
    use WithPagination;
    public $search = '';
    public $nameSearch = '';
    public $emailSearch = '';
    public $phoneSearch = '';
    public $roleSearch = '';
    public $perPage = 5;
    public function render()
    {
        $users = User::query()
            ->with('roles')
            ->where('name', 'like', '%' . $this->search . '%')
            ->when($this->nameSearch, function ($query) {
                $query->where('name', 'like', '%' . $this->nameSearch . '%');
            })
            ->when($this->emailSearch, function ($query) {
                $query->where('email', 'like', '%' . $this->emailSearch . '%');
            })
            ->when($this->phoneSearch, function ($query) {
                $query->where('phone', 'like', '%' . $this->phoneSearch . '%');
            })
            ->when($this->roleSearch, function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', $this->roleSearch);
                });
            })
            ->latest()
            ->paginate($this->perPage);
        $roles = \Spatie\Permission\Models\Role::all();

        return view('livewire.admin.user.index', ['users' => $users, 'roles' => $roles]);
    }

    public function export()
    {
        return Excel::download(new UsersExport,'user.xlsx');
    }
    //    reset filter
    public function resetFilter()
    {
        $this->reset(['search', 'nameSearch', 'emailSearch', 'phoneSearch', 'roleSearch']);
        $this->resetPage();

    }

    // delete user with photo profile
    public function delete($id)
    {
        $user = User::find($id);
        if ($user->profile_photo_path) {
            unlink('storage/' . $user->profile_photo_path);
        }
        $user->delete();
        $this->dispatch('success', [
            'message' => 'User Deleted Successfully.'
        ]);
    }
    public function updateStatus($id)
    {
        $user = User::find($id);
        $user->status = !$user->status;
        $user->save();
        if ($user->status) {
            $this->dispatch('success', [
                'message' => 'User ' . $user->name . ' Activated Successfully.'
            ]);
        } else {
            $this->dispatch('success', [
                'message' => 'User ' . $user->name . ' Deactivated Successfully.'
            ]);
        }
    }


}
