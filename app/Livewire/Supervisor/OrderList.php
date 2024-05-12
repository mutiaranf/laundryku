<?php

namespace App\Livewire\Supervisor;

use App\Models\Order;
use Livewire\Component;

class OrderList extends Component
{
    public function render()
    {
        $orders = Order::with('customer','detailOrder')->latest()->paginate(5);
        return view('livewire.supervisor.order-list', compact('orders'));
    }



}
