<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

#[Title('Edit User')]
class Edit extends Component
{
    use WithFileUploads;
    public function render()
    {
        return view('livewire.admin.user.edit');
    }

    public $id, $name , $email, $password,  $password_confirmation, $profile_photo_path, $user_role, $phone, $old_photo, $profile_photo_url;
    public $roles;
    // Show role in form select
    public function roles()
    {
        return Role::where('name', '!=', 'staff')->get();
    }

    public function mount($id): void
    {
        $this->roles = $this->roles();
        $user = User::find($id);
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->old_photo = $user->profile_photo_path;
        $this->profile_photo_url = $user->profile_photo_url;
        $this->user_role = $user->roles->first()->name;
    }

    protected function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'phone' => 'required|unique:users,phone,'.$this->id,
            'password' => 'nullable|min:6',
            'password_confirmation' => 'nullable|same:password',
            'profile_photo_path' => 'max:3024',
        ];
    }
    // update user with photo profile
    public function update(): void
    {
        $this->validate();
        $user = User::find($this->id);
        if($this->profile_photo_path){
            if($this->old_photo){
                unlink('storage/'.$this->old_photo);
            }
            $this->profile_photo_path = $this->profile_photo_path->store('profile-photos', 'public');
        }else{
            $this->profile_photo_path = $this->old_photo;
        }
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        if($this->password){
            $user->password = bcrypt($this->password);
        }
        $user->profile_photo_path = $this->profile_photo_path;
        $user->save();
        $user->removeRole($this->user_role);
        $user->assignRole($this->user_role);
        session()->flash('success', 'User Updated Successfully.');
        redirect()->to('/user');
    }
}
