<?php

namespace App\Livewire\Admin\Outlet;

use Carbon\Carbon;
use App\Models\Outlet;
use Livewire\Component;
use App\Models\CashBalance;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Create extends Component
{
    use WithFileUploads;

    public function render()
    {

        return view('livewire.admin.outlet.create');
    }

    #[Validate('required|image|max:3024')]
    public $photo;
    #[Validate('required|min:5|max:255')]
    public $name;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $phone;
    #[Validate('required')]
    public $latitude;
    #[Validate('required')]
    public $longitude;
    #[Validate('required')]
    public $status;
    #[Validate('required')]
    public $start_operation;
    #[Validate('required')]
    public $end_operation;
    #[Validate('required')]
    public $cashBalance;

    public function store()
    {
        $this->validate();
        if ($this->photo) {
            $this->photo = $this->photo->store('outlet-photos', 'public');
        }

        Outlet::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'photo' => $this->photo,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'status' => $this->status,
            'start_operation' => $this->start_operation,
            'end_operation' => $this->end_operation,
        ]);

        $cashBalance = new CashBalance();
        $cashBalance->outlet_id = Outlet::latest()->first()->id;
        $cashBalance->amount = $this->cashBalance;
        $cashBalance->balance_date = Carbon::now();
        $cashBalance->description = 'Cash Balance for '.$this->name.' outlet';
        $cashBalance->save();



        session()->flash('success', 'Outlet Created Successfully.');
        return redirect()->to('/outlet');
    }
}
