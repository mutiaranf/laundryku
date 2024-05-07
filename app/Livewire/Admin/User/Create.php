<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
#[Title('Create User')]
class Create extends Component
{
    use WithFileUploads;


    public function render()
    {
        return view('livewire.admin.user.create');
    }

    public $id, $name , $email, $password,  $password_confirmation, $profile_photo_path, $user_role, $phone;
    public $roles;
    // Show role in form select
    public function roles()
    {
        return Role::where('name', '!=', 'staff')->get();
    }

    public function mount()
    {
        $this->roles = $this->roles();

    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'profile_photo_path' => 'max:3024',
        ]);



        // storing image and get path checkif image is not empty
        if($this->profile_photo_path){
            $this->profile_photo_path = $this->profile_photo_path->store('profile-photos', 'public');
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'profile_photo_path' => $this->profile_photo_path,
        ]);
        // assign role to user
        $user->assignRole('superadmin');

    session()->flash('success', 'User Created Successfully.');
    redirect()->to('/user');



    }



}
