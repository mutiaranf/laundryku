<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.admin.customer.create');
    }

    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $phone;
    public $address;
    public $latitude;
    public $longitude;


    public function store(){
        $this->validate();

        $customer = new Customer();
        $customer->name = $this->name;
        $customer->phone = $this->phone;
        $customer->address = $this->address;
        $customer->save();

        session()->flash('success', 'Customer created successfully!');
        return redirect()->route('customer');
    }




}
