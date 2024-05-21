<?php

namespace App\Livewire\Admin\Outlet;

use App\Models\Order;
use App\Models\Income;
use App\Models\Outlet;
use App\Models\Expense;
use Livewire\Component;
use App\Models\CashBalance;
use Livewire\WithPagination;
use App\Exports\OutletsExport;

use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    public $search = '';
    public $addressSearch = '';
    public $perPage = 5;

    public function render()
    {
        $outlets = Outlet::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->when($this->addressSearch, function ($query) {
                $query->where('address', 'like', '%' . $this->addressSearch . '%');
            })
            ->latest()
            ->paginate($this->perPage);
        $balanceData = CashBalance::with('outlet')->latest()->paginate(5);

        return view('livewire.admin.outlet.index', ['outlets' => $outlets, 'balanceData' => $balanceData]);
    }

    public function deleteBalance($id)
    {
        $cashBalance = CashBalance::find($id);
        $cashBalance->delete();
        $this->dispatch('success',[
            'message' => 'Cash Balance Deleted Successfully.'
        ]);
    }

    public $financialOutletModal = false;
    public $detailOutletModal = false;
    public $cashBalance;
    public $income;
    public $expense;
    public $profit;
    public $customer_count;
    public $order_count;

    public $ordersRecap;
    public function showFinanceOutlet($id)
    {
        $this->reset(['cashBalance','income','expense','profit','customer_count','order_count','photo','name','address','phone','latitude','longitude','status','start_operation','end_operation','financialOutletModal','detailOutletModal']);
        $this->financialOutletModal = true;
        $CashBalance = CashBalance::where('outlet_id', $id)->first();

        $income = Income::where('outlet_id', $id)
                        ->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->sum('amount');
        $expense = Expense::where('outlet_id', $id)
                        ->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->sum('amount');
        // order recap with data : count order cancelled, order processed, order completed by month
        $this->ordersRecap = Order::selectRaw('MONTHNAME(created_at) as month,
                        SUM(CASE WHEN order_status = "completed" THEN 1 ELSE 0 END) as completed,
                        SUM(CASE WHEN order_status = "processed" THEN 1 ELSE 0 END) as processed,
                        SUM(CASE WHEN order_status = "cancelled" THEN 1 ELSE 0 END) as cancelled')
                        ->where('outlet_id', $id)
                        ->whereYear('created_at', now()->year)
                        ->groupBy('month')
                        ->get();


        $profit = $income - $expense;
        $customer_count = Order::where('outlet_id', $id)->distinct('customer_id')->count('customer_id');
        $order_count = Order::where('outlet_id',$id)->count();
        $this->cashBalance = $CashBalance->amount;
        $this->income = $income;
        $this->expense = $expense;
        $this->profit = $profit;
        $this->customer_count = $customer_count;
        $this->order_count = $order_count;
    }

    public function resetFilter()
    {
        $this->reset(['search','addressSearch']);
        $this->resetPage();

    }

    public function export()
    {
        return Excel::download(new OutletsExport,'outlet.xlsx');
    }
    public $photo;
    public $name;
    public $address;
    public $phone;
    public $latitude;
    public $longitude;
    public $status;
    public $start_operation;
    public $end_operation;
    public function show($id)
    {
        $this->detailOutletModal = true;
        $outlet = Outlet::find($id);
        $this->name = $outlet->name;
        $this->address = $outlet->address;
        $this->phone = $outlet->phone;
        $this->latitude = $outlet->latitude;
        $this->longitude = $outlet->longitude;
        $this->status = $outlet->status;
        $this->photo = $outlet->photo;
        $this->start_operation = $outlet->start_operation;
        $this->end_operation = $outlet->end_operation;
    }

    //   delete outlet with photo
    public function delete($id)
    {
        try{
            $outlet = Outlet::find($id);
            if($outlet->photo){
                unlink('storage/'.$outlet->photo);
            }
            $outlet->delete();
            $this->dispatch('success',[
                'message' => 'Outlet Deleted Successfully.'
            ]);
        } catch(\Exception $e){
            $this->dispatch('error',[
                'message' => "Masih Terikat dengan data yg lain spt karyawan dll"
            ]);
        }

    }
}
