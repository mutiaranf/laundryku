<?php

namespace App\Livewire\Supervisor;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;
    public $outlet_id;
    public function __construct()
    {
        $this->outlet_id = Employee::find(auth()->user()->employee_id)->outlet_id;
    }
    public function render()
    {
        $orders = Order::with('customer','detailOrder')->where('outlet_id' , $this->outlet_id)->latest()->paginate(5);
        return view('livewire.supervisor.order-list', compact('orders'));
    }



}
