<?php

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supervisor\PrintStruct;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');
    // route for superadmin
    Route::middleware(['role:superadmin'])->group(function () {
        // user
        Route::get('/user', \App\Livewire\Admin\User\Index::class)->name('user');
        Route::get('/user/create', \App\Livewire\Admin\User\Create::class)->name('user.create');
        Route::get('/user/edit/{id}', \App\Livewire\Admin\User\Edit::class)->name('user.edit');
        // outlet
        Route::get('/outlet', \App\Livewire\Admin\Outlet\Index::class)->name('outlet');
        Route::get('/outlet/create', \App\Livewire\Admin\Outlet\Create::class)->name('outlet.create');
        Route::get('/outlet/edit/{id}', \App\Livewire\Admin\Outlet\Edit::class)->name('outlet.edit');
        // position
        Route::get('/position', \App\Livewire\Admin\Position\Index::class)->name('position');
        // employee
        Route::get('/employee', \App\Livewire\Admin\Employee\Index::class)->name('employee');
        Route::get('/employee/create', \App\Livewire\Admin\Employee\Create::class)->name('employee.create');
        Route::get('/employee/edit/{id}', \App\Livewire\Admin\Employee\Edit::class)->name('employee.edit');
        // customer
        Route::get('/customer', \App\Livewire\Admin\Customer\Index::class)->name('customer');
        Route::get('/customer/create', \App\Livewire\Admin\Customer\Create::class)->name('customer.create');
        Route::get('/customer/edit/{id}', \App\Livewire\Admin\Customer\Edit::class)->name('customer.edit');
        // service
        Route::get('/service', \App\Livewire\Admin\Service\Index::class)->name('service');
        // Stock
        Route::get('/stock', \App\Livewire\Admin\Stock\Index::class)->name('stock');

        // Report
        Route::get('/report', \App\Livewire\Admin\Report\PrintReport::class)->name('report');


        Route::get('/print-pdf-order-report-day', function () {

            $orders = session('orders');

            if ($orders == null) {
                return redirect()->back()->with('error', 'Data orders tidak ditemukan.');
            }
            return view('export-pdf-view.pdf-report-day', compact('orders'));

        })->name('print-pdf-order-report-day');

        Route::get('/print-pdf-order-report-month', function () {

            $orders = session('orders');

            if ($orders == null) {
                return redirect()->back()->with('error', 'Data orders tidak ditemukan.');
            }
            return view('export-pdf-view.pdf-report-day', compact('orders'));

        })->name('print-pdf-order-report-month');

        Route::get('/print-pdf-order-report-year', function () {

            $orders = session('orders');

            if ($orders == null) {
                return redirect()->back()->with('error', 'Data orders tidak ditemukan.');
            }
            return view('export-pdf-view.pdf-report-day', compact('orders'));

        })->name('print-pdf-order-report-year');

    });
    // route for supervisor
    Route::middleware(['role:supervisor'])->group(function () {
        Route::get('/quick-order', \App\Livewire\Supervisor\QuickOrder::class)->name('quick-order');
        Route::get('/order-list', \App\Livewire\Supervisor\OrderList::class)->name('order-list');
        Route::get('/order-queue', \App\Livewire\Supervisor\OrderQueue::class)->name('order-queue');
        Route::get('/expense', \App\Livewire\Supervisor\Expense\Index::class)->name('expense');
        Route::get('/stockOutlet', \App\Livewire\Supervisor\Stock\Index::class)->name('stockOutlet');
        Route::get('/print-struct/{id}', [PrintStruct::class, 'index'])->name('print-struct');
    });

});
