<?php

namespace App\Livewire\Admin\Employee;

use App\Models\Outlet;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    public $search;
    public $emailSearch;
    public $phoneSearch;
    public $outletSearch;

    public $positionSearch;
    public $perPage = 5;

    public function render()
    {
        $employees = Employee::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->when($this->emailSearch, function ($query) {
                $query->where('email', 'like', '%' . $this->emailSearch . '%');
            })
            ->when($this->phoneSearch, function ($query) {
                $query->where('phone', 'like', '%' . $this->phoneSearch . '%');
            })
            ->when($this->outletSearch, function ($query) {
                $query->where('outlet_id', $this->outletSearch);
            })
            ->when($this->positionSearch, function ($query) {
                $query->where('position_id', $this->positionSearch);
            })
            ->latest()
            ->paginate(5);
        $outlets = Outlet::all();
        $positions = Position::all();
        return view('livewire.admin.employee.index', compact('employees', 'outlets', 'positions'));
    }

    public function resetFilter()
    {
        $this->reset(['search', 'emailSearch', 'phoneSearch', 'outletSearch', 'positionSearch']);
    }

    public function delete($id)
    {

        try{
            $employee = Employee::find($id);
            $employee->delete();
            $this->dispatch('success', [
                'message' => 'Employee deleted successfully.'
            ]);
        } catch (\Exception $e) {

            $this->dispatch('error', [
                'message' => 'Masih terikat dengan data lain.'
            ]);
        }
    }

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
    public $outlet_name;
    public $position_name;


    public function show($id)
    {
        $employee = Employee::with('outlet', 'position')->find($id);
        $this->outlet_name = $employee->outlet->name;
        $this->position_name = $employee->position->name;
        $this->name = $employee->name;
        $this->email = $employee->email;
        $this->phone = $employee->phone;
        $this->gender = $employee->gender;
        $this->dob = $employee->dob;
        $this->account_number = $employee->account_number;
        $this->address = $employee->address;
        $this->salary = $employee->salary;
        $this->photo = $employee->photo;
        $this->status = $employee->status;
    }

    public function export()
    {
        return Excel::download(new EmployeeExport,'employee.xlsx');
    }

    public function edit($id)
    {
        $employee = Employee::with('outlet','position')->find($id);
        $this->outlet_name = $employee->outlet->name;
        $this->position_name = $employee->position->name;
        $this->name = $employee->name;
        $this->email = $employee->email;
        $this->phone = $employee->phone;
        $this->gender = $employee->gender;
        $this->dob = $employee->dob;
        $this->account_number = $employee->account_number;
        $this->address = $employee->address;
        $this->salary = $employee->salary;
        $this->photo = $employee->photo;
        $this->status = $employee->status;

    }


}
