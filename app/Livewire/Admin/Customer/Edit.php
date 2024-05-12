<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.admin.customer.edit');
    }
    public $id;
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $phone;
    public $address;
    public $latitude;
    public $longitude;

    public function mount($id){
        $customer = Customer::findOrFail($id);
        $customer->id = $this->id;
        $this->name = $customer->name;
        $this->phone = $customer->phone;
        $this->address = $customer->address;
        $this->latitude = $customer->latitude;
        $this->longitude = $customer->longitude;
    }

    public function update()
    {
        $this->validate();
        $customer = Customer::findOrFail($this->id);
        $customer->name = $this->name;
        $customer->phone = $this->phone;
        $customer->address = $this->address;
        $customer->latitude = $this->latitude;
        $customer->longitude = $this->longitude;
        $customer->save();

        session()->flash('success', 'Customer updated successfully!');
        return redirect()->route('customer');
    }
}
