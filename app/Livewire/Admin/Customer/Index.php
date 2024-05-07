<?php

namespace App\Livewire\Admin\Customer;

use Livewire\Component;

class Index extends Component
{
    public $search;
    public $phoneSearch;
    public $addressSearch;
    public $perPage = 5;

    public function render()
    {
        $customers = \App\Models\Customer::query()
       ->where('name', 'like', '%' . $this->search . '%')
         ->when($this->phoneSearch, function ($query) {
              $query->where('phone', 'like', '%' . $this->phoneSearch . '%');
            })
            ->when($this->addressSearch, function ($query) {
                $query->where('address', 'like', '%' . $this->addressSearch . '%');
            })
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.admin.customer.index',compact('customers'));
    }

    public function resetFilter()
    {
        $this->reset(['search', 'phoneSearch', 'addressSearch']);
    }

    public function delete($id)
    {
        $customer = \App\Models\Customer::find($id);
        $customer->delete();
        $this->dispatch('success', [
            'message' => 'Customer deleted successfully.'
        ]);
    }




}
