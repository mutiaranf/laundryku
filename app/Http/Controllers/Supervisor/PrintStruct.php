<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Order;
use App\Models\Employee;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Models\ServicePackage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PrintStruct extends Controller
{


    public function index($id){
        $data = DB::table('orders')
            ->join('detail_orders', 'orders.id', '=', 'detail_orders.order_id')
            ->where('orders.id', $id)
            ->where('orders.order_status', 'Completed')
            ->get();

        $customerName = Order::with('customer')->where('id', $id)->first()->customer->name;



        $dataStruct = []; // Initialize an empty array to store the data for
        foreach ($data as $key => $value) {
            $dataStruct[] = [
                'item' => ServiceType::where('id', $value->service_type_id)->first()->name ?? ServicePackage::where('id', $value->service_package_id)->first()->name ?? '',
                'qty' => $value->quantity,
                'price' => $value->price,
                'total' => $value->total_price,
            ];
        }
        $totalPrice = $data->sum('total_price');
        $outletAdress = Employee::with('outlet')->find(auth()->user()->employee_id)->outlet->address;
        $outletName = Employee::with('outlet')->find(auth()->user()->employee_id)->outlet->name;


        return view('livewire.supervisor.struct-order',compact('dataStruct','totalPrice','outletAdress','outletName','customerName'));
    }
}
