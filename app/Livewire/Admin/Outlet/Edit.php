<?php

namespace App\Livewire\Admin\Outlet;

use Carbon\Carbon;
use App\Models\Outlet;
use Livewire\Component;
use App\Models\CashBalance;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    use WithFileUploads;
    public function render()
    {
        return view('livewire.admin.outlet.edit');
    }


    public function mount($id): void
    {
        $outlet = Outlet::find($id);
        $this->id = $outlet->id;
        $this->name = $outlet->name;
        $this->address = $outlet->address;
        $this->phone = $outlet->phone;
        $this->latitude = $outlet->latitude;
        $this->longitude = $outlet->longitude;
        $this->status = $outlet->status;
        $this->start_operation = $outlet->start_operation;
        $this->end_operation = $outlet->end_operation;
        $this->old_photo = $outlet->photo;
    }

    public $id;
    public $old_photo;
    #[Validate('max:3024')]
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

    public function update()
    {
        $this->validate();
        if ($this->photo) {
            if ($this->old_photo) {
                unlink('storage/' . $this->old_photo);
            }
            $this->photo = $this->photo->store('profile-photos', 'public');
        } else {
            $this->photo = $this->old_photo;
        }

        $outlet = Outlet::find($this->id);
        $outlet->name = $this->name;
        $outlet->address = $this->address;
        $outlet->phone = $this->phone;
        $outlet->photo = $this->photo;
        $outlet->latitude = $this->latitude;
        $outlet->longitude = $this->longitude;
        $outlet->status = $this->status;
        $outlet->start_operation = $this->start_operation;
        $outlet->end_operation = $this->end_operation;
        $outlet->save();

        $cashBalance = new CashBalance();
        $cashBalance->outlet_id = $this->id;
        $cashBalance->amount = $this->cashBalance;
        $cashBalance->balance_date = Carbon::now();
        $cashBalance->description = 'Cash Balance for '.$this->name.' outlet';
        $cashBalance->save();

        session()->flash('success', 'Outlet Updated Successfully.');
        return redirect()->to('/outlet');
    }
}
