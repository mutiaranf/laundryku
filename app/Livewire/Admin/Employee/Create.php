<?php

namespace App\Livewire\Admin\Employee;

use App\Models\Outlet;
use App\Models\Position;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public function render()
    {
        $outlets = Outlet::all();
        $positions = Position::all();
        return view('livewire.admin.employee.create', compact('outlets', 'positions'));
    }

    #[Validate('required|string|max:255')]
    public $name;
    #[Validate('required|email')]
    public $email;
    #[Validate('required|numeric')]
    public $phone;
    #[Validate('required')]
    public $gender;
    #[Validate('required')]
    public $dob;
    #[Validate('required')]
    public $account_number;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $salary;
    #[Validate('max:255')]
    public $photo;
    #[Validate('required')]
    public $status;

    public $outlet_id;
    public $position_id;

//    store employee with photo
    public function store()
    {
        $this->validate();
        if ($this->photo) {
            $this->photo = $this->photo->store('employee-photos', 'public');
        }

        $employee = new \App\Models\Employee();
        $employee->outlet_id = $this->outlet_id;
        $employee->position_id = $this->position_id;
        $employee->name = $this->name;
        $employee->email = $this->email;
        $employee->phone = $this->phone;
        $employee->gender = $this->gender;
        $employee->dob = $this->dob;
        $employee->account_number = $this->account_number;
        $employee->address = $this->address;
        $employee->salary = $this->salary;
        $employee->photo = $this->photo;
        $employee->status = $this->status;
        $employee->save();



        session()->flash('success', 'Employee Created Successfully.');
        return redirect()->to('/employee');




    }
}
