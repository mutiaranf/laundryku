<?php

namespace App\Http\Controllers\Supervisor;

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

        return view('livewire.supervisor.struct-order',compact('dataStruct','totalPrice'));
    }
}
