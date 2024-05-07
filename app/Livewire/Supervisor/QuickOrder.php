<?php

namespace App\Livewire\Supervisor;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Income;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\CashBalance;
use App\Models\DetailOrder;
use App\Models\ServiceType;
use App\Models\PieceService;
use App\Models\ServicePackage;
use App\Models\TransactionOrder;
use PhpParser\Node\Expr\Cast\Double;

class QuickOrder extends Component
{



    public function render()
    {
        $serviceTypes = ServiceType::all();
        $servicePackages = ServicePackage::all();
        $pieceServices = PieceService::all();
        return view('livewire.supervisor.quick-order', compact('serviceTypes', 'servicePackages', 'pieceServices'));
    }

    public $outletId;
    public function __construct()
    {
        $employeeId = auth()->user()->employee_id;
        $this->outletId = Employee::where('id', $employeeId)->first()->id;
    }


    public $searchTerm = '';
    public $selectedCustomerId;

    public $selectedCustomerName;
    public $selectedCustomerPhone;
    public $showCustomerInfo = false;
    public function searchCustomerAndShow()
    {
        $customer = Customer::where('phone', $this->searchTerm)->first();

        if ($customer) {
            if ($this->selectedCustomerId != $customer->id) {
                $this->selectedCustomerId = $customer->id;
                $this->selectedCustomerName = $customer->name;
                $this->selectedCustomerPhone = $customer->phone;
                $this->showCustomerInfo = true;
                $this->reset('searchTerm');
            }
        } else {
            $this->clearSelectedCustomer();
        }
    }

    public function clearSelectedCustomer()
    {
        $this->selectedCustomerName = null;
        $this->selectedCustomerPhone = null;
        $this->showCustomerInfo = false;
        $this->selectedCustomerId = null;

        $this->reset('searchTerm');
    }

    public $customerName;
    public $customerPhone;
    public $customerAddress;
    public $customerLatitude;
    public $customerLongitude;

    public $showAddCustomer = false;

    public function toggleAddCustomer()
    {

        $this->showAddCustomer = !$this->showAddCustomer;
        $this->clearSelectedCustomer();
    }

    public function addCustomer()
    {
        $this->validate([
            'customerName' => 'required',
            'customerPhone' => 'required',
        ]);

        $customer = new Customer();


        $customer->name = $this->customerName;
        $customer->phone = $this->customerPhone;
        $customer->address = $this->customerAddress;
        $customer->latitude = $this->customerLatitude;
        $customer->longitude = $this->customerLongitude;
        $customer->save();
        if ($customer) {
            $this->selectedCustomerId = $customer->id;
            $this->selectedCustomerName = $customer->name;
            $this->selectedCustomerPhone = $customer->phone;
            $this->showCustomerInfo = true;
            $this->showAddCustomer = false;
            $this->reset('customerName', 'customerPhone', 'customerAddress', 'customerLatitude', 'customerLongitude');
        }
    }

    public $selectedServices = [];
    public $maxEstimatedTime;
    public function calculateEstimatedCompletionTime()
    {
        $this->maxEstimatedTime = 0;
        foreach ($this->selectedServices as $service) {
            if ($service['estimated_time'] > $this->maxEstimatedTime) {
                $this->maxEstimatedTime = $service['estimated_time'];
            }
        }
        return $this->maxEstimatedTime;
    }

    public function addServiceType(string $serviceTypeName, int $serviceTypeId, float $serviceTypePrice, int $serviceTypeEstimatedTime)
    {
        // cek apakah service sudah ada di selected service
        $existingServiceIndex = null;
        foreach ($this->selectedServices as $index => $service) {
            if ($service['name'] === $serviceTypeName) {
                $existingServiceIndex = $index;
                break;
            }
        }

        if ($existingServiceIndex !== null) {
            $this->selectedServices[$existingServiceIndex]['quantity']++;
        } else {
            $this->selectedServices[] = [
                'name' => $serviceTypeName,
                'type' => 'ServiceType',
                'quantity' => 1,
                'price' => $serviceTypePrice,
                'id' => $serviceTypeId,
                'estimated_time' => $serviceTypeEstimatedTime,
            ];
        }

        $this->calculatePrice(); // Memanggil fungsi untuk menghitung total harga setelah menambahkan service
        $this->calculateEstimatedCompletionTime();
    }

    public function addServicePackage(string $servicePackageName, int $servicePackageId, float $servicePackagePrice, int $servicePackageEstimatedTime)
    {
        // cek apakah service sudah ada di selected service
        $existingServiceIndex = null;
        foreach ($this->selectedServices as $index => $service) {
            if ($service['name'] === $servicePackageName) {
                $existingServiceIndex = $index;
                break;
            }
        }

        if ($existingServiceIndex !== null) {
            $this->selectedServices[$existingServiceIndex]['quantity']++;
        } else {
            $this->selectedServices[] = [
                'name' => $servicePackageName,
                'type' => 'ServicePackage',
                'quantity' => 1,
                'price' => $servicePackagePrice,
                'id' => $servicePackageId,
                'estimated_time' => $servicePackageEstimatedTime,
            ];
        }

        $this->calculatePrice(); // Memanggil fungsi untuk menghitung total harga setelah menambahkan service
        $this->calculateEstimatedCompletionTime();
    }

    public function removeService(string $serviceName, int $serviceId)
    {
        foreach ($this->selectedServices as $key => $service) {
            if ($service['id'] === $serviceId && $service['name'] === $serviceName) {
                unset($this->selectedServices[$key]);
                $this->selectedServices = array_values($this->selectedServices); // Reindex array

                $this->calculatePrice(); // Memanggil fungsi untuk menghitung total harga setelah menghapus service
                break;
            }
        }
    }

    public function incrementQuantity(string $serviceName, int $serviceId)
    {
        foreach ($this->selectedServices as $key => $service) {
            if ($service['id'] === $serviceId && $service['name'] === $serviceName) {
                $this->selectedServices[$key]['quantity']++;
                $this->calculatePrice();
                break;
            }
        }

    }
    public function decrementQuantity(string $serviceName, int $serviceId)
    {
        foreach ($this->selectedServices as $key => $service) {
            if ($service['id'] === $serviceId && $service['name'] === $serviceName) {
                if ($this->selectedServices[$key]['quantity'] > 1) {
                    $this->selectedServices[$key]['quantity']--;
                }
                $this->calculatePrice();
                break;
            }
        }
    }

    public $totalPrice = 0;
    public function calculatePrice()
    {
        $this->totalPrice = 0; // Reset total price sebelum menghitung ulang
        foreach ($this->selectedServices as $service) {
            $this->totalPrice += $service['price'] * $service['quantity'];
        }
        return $this->totalPrice;
    }

    public $notes;
    public $total_amount;


    public function createOrder()
    {
        $this->validate([
            'selectedCustomerId' => 'required',

        ]);
        $order = new Order();
        $order->customer_id = $this->selectedCustomerId;
        $order->outlet_id = $this->outletId;
        $order->order_date = date('Y-m-d H:i:s');
        $order->estimated_completion_time = date('Y-m-d H:i:s', strtotime('+' . $this->maxEstimatedTime . ' hours'));
        $order->order_status = 'new';
        $order->notes = $this->notes;
        $order->save();

        if ($order->save() && $this->selectedServices != []) {

            $orderId = $order->id; // Mengambil order_id dari data yang telah disimpan sebelumnya
            foreach ($this->selectedServices as $key => $service) {
                $detailOrderService = new DetailOrder();
                $detailOrderService->quantity = $service['quantity'];
                $detailOrderService->order_id = $orderId;
                $detailOrderService->price = $service['price'];
                if ($service['type'] === 'ServiceType') {
                    $detailOrderService->service_type_id = $service['id'];
                } elseif ($service['type'] === 'ServicePackage') {
                    $detailOrderService->service_package_id = $service['id'];
                }
                $detailOrderService->total_price = $service['price'] * $service['quantity'];
                $detailOrderService->save();

            }

            $transaction = new TransactionOrder();
            $transaction->order_id = $orderId;
            $transaction->transaction_date = date('Y-m-d H:i:s');
            $transaction->total_amount = $this->totalPrice;
            $transaction->payment_status = "paid";
            $transaction->save();






            return redirect()->to('/order-queue')->with('success', 'Berhasil memesan');

        } else {
            $this->dispatch('error', [
                'message'=> 'Anda belum memilih layanan laundry'
            ]);
        }

    }






}
