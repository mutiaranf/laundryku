<?php

namespace App\Livewire\Admin\Employee;

use App\Models\Outlet;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public function render()
    {
        $outlets = Outlet::all();
        $positions = Position::all();
        return view('livewire.admin.employee.edit', compact('outlets','positions'));
    }

    public function mount($id){
        $employee = Employee::with('position', 'outlet')->findOrFail($id);
        $this->id = $employee->id;
        $this->name = $employee->name;
        $this->email = $employee->email;
        $this->phone = $employee->phone;
        $this->gender = $employee->gender;
        $this->dob = $employee->dob;
        $this->account_number = $employee->account_number;
        $this->address = $employee->address;
        $this->salary = $employee->salary;
        $this->status = $employee->status;
        $this->oldPhoto = $employee->photo;
        $this->position_id = $employee->position->id;
        $this->outlet_id = $employee->outlet->id;
        $this->position = $employee->position->name;
        $this->outlet = $employee->outlet->name;
    }


    public $id;
    public $name;
    public $email;
    public $phone;
    public $gender;
    public $dob;
    public $account_number;
    public $address;
    public $salary;
    public $photo;
    public $status;


    public $oldPhoto;
    public $outlet_id;
    public $outlet;
    public $position_id;
    public $position;

    protected function rules() : array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $this->id,
            'phone' => 'required|numeric|unique:employees,phone,' . $this->id,
            'gender' => 'required',
            'dob' => 'required',
            'account_number' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'photo' => 'max:255',
            'status' => 'required',
        ];
    }
    public function update()
    {
        $this->validate();

        $employee = Employee::find($this->id);
        if ($this->photo) {
            if ($this->oldPhoto) {
                unlink('storage/' . $this->oldPhoto);
            }
            $this->photo = $this->photo->store('employee-photos', 'public');
        } else {
            $this->photo = $this->oldPhoto;
        }

        $employee->name = $this->name;
        $employee->email = $this->email;
        $employee->phone = $this->phone;
        $employee->gender = $this->gender;
        $employee->dob = $this->dob;
        $employee->account_number = $this->account_number;
        $employee->address = $this->address;
        $employee->salary = $this->salary;
        $employee->status = $this->status;
        $employee->photo = $this->photo;
        $employee->outlet_id = $this->outlet_id;
        $employee->position_id = $this->position_id;
        $employee->save();

        session()->flash('success', 'Employee Updated Successfully.');
        return redirect()->to('/employee');
    }
}
