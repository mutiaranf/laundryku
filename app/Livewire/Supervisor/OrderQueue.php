<?php

namespace App\Livewire\Supervisor;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Income;
use Livewire\Component;
use App\Models\Employee;
use App\Models\CashBalance;
use App\Models\ServiceType;
use Livewire\WithPagination;
use App\Models\ServicePackage;

class OrderQueue extends Component
{


    public $outlet_id;
    public function __construct()
    {
        $this->outlet_id = Employee::find(auth()->user()->employee_id)->outlet_id;
    }


    use WithPagination;
    public function render()
    {
        $orders = Order::with('detailOrder', 'customer')
            ->where('outlet_id', $this->outlet_id)
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->orderByRaw("FIELD(order_status, 'Completed', 'Cancelled') ASC")
            ->paginate(5);
        $customer_count = Order::whereDate('created_at', today())->distinct('customer_id')->count('customer_id');
        $order_queue_count = Order::whereDate('created_at', today())
            ->whereIn('order_status', ['New', 'Processed'])
            ->count();
        $order_completed_count = Order::whereDate('created_at', today())
            ->where('order_status', 'Completed')
            ->count();

        return view('livewire.supervisor.order-queue', compact('orders', 'customer_count', 'order_queue_count', 'order_completed_count'));
    }
    public $order_id;
    public $showOrderInfo = false;
    public $customer_name;
    public $estimated_time;
    public $order_status;
    public $total_price;

    public $note;

    public $services = [];
    public function show($id)
    {
        $order = Order::with('detailOrder', 'customer')->find($id);
        $this->order_id = $order->id;
        $this->customer_name = $order->customer->name;
        $this->estimated_time = $order->estimated_completion_time;
        $this->order_status = $order->order_status;
        $this->total_price = $order->getTotalPriceAttribute();
        $this->note = $order->notes;
        $this->services = [];
        $order->detailOrder->map(function ($item) {
            if ($item->service_type_id != null) {
                $this->services[] = [
                    'service_name' => ServiceType::find($item->service_type_id)->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total_price' => $item->price * $item->quantity
                ];
            }

        });

        $this->showOrderInfo = true;
    }



    public function changeStatus($id, $status)
    {
        $order = Order::find($id);
        if ($status == 'Completed') {
            if ($order->order_status != 'Cancelled') {
                $income = new Income();
                $income->outlet_id = $order->outlet_id;
                $income->order_id = $order->id;
                $income->amount = $order->getTotalPriceAttribute();
                $income->income_date = Carbon::now();
                $income->description = 'Income from order ' . $order->id;
                $income->save();

                $cashBalance = CashBalance::where('outlet_id', $order->outlet_id)->first();
                $cashBalance->amount += $order->getTotalPriceAttribute(); // Menggunakan operator += untuk menambahkan jumlah
                $cashBalance->balance_date = Carbon::now();
                $cashBalance->save();
                $order->order_status = $status;
                $order->save();
                $this->order_status = $order->order_status;
                $this->dispatch('success', [
                    'message' => 'Order status changed to ' . $status
                ]);
            } else {
                $this->dispatch('error', [
                    'message' => 'Order status cannot be changed to ' . $status
                ]);
            }
        } elseif ($status == 'Cancelled') {
            if ($order->order_status != 'Completed') {

                $order->order_status = $status;
                $order->save();
                $this->order_status = $order->order_status;
                $this->dispatch('success', [
                    'message' => 'Order status changed to ' . $status
                ]);
            } else {
                $this->dispatch('error', [
                    'message' => 'Order status cannot be changed to ' . $status
                ]);
            }
        } elseif ($status == 'Processed') {
            $order->order_status = $status;
            $order->save();
        } else {
            $this->dispatch('error', [
                'message' => 'Order status cannot be changed to ' . $status
            ]);
        }


    }


}
