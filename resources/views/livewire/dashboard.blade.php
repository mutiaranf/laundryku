@role('superadmin')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash1.svg" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            Rp. <span class="counters"
                                data-count="{{ $totalCashBalance }}">{{ number_format($totalCashBalance, 0, ',', '.') }}</span>
                        </h5>
                        <h6>Total Saldo Kas </h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash2.svg" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            Rp. <span class="counters"
                                data-count="{{ $totalIncome }}">{{ number_format($totalIncome, 0, ',', '.') }}</span>
                        </h5>
                        <h6>Total Pendapatan</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash3.svg" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            Rp. <span class="counters"
                                data-count="{{ $totalProfit }}">{{ number_format($totalProfit, 0, ',', '.') }}</span>
                        </h5>
                        <h6>Total Keuntungan</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash4.svg" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            Rp. <span class="counters"
                                data-count="{{ $totalExpense }}">{{ number_format($totalExpense, 0, ',', '.') }}</span>
                        </h5>
                        <h6>Total Pengeluaran</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>{{ $totalCustomerCount }}</h4>
                        <h5>Total Customers</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>{{ $totalEmployeeCount }}</h4>
                        <h5>Total Employee</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das2">
                    <div class="dash-counts">
                        <h4>{{ $totalOutletCount }}</h4>
                        <h5>Total Outlet</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file-text"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4>{{ $totalOrderCount }}</h4>
                        <h5>Total Order</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recently Completed Order</h5>
                        <div class="graph-sets">
                            <ul>
                                <li>
                                    <span>Sales</span>
                                </li>
                                <li>
                                    <span>Purchase</span>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    2022
                                    <img src="assets/img/icons/dropdown.svg" alt="img" class="ms-2" />
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2020</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sales_charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Recently Completed Order</h4>
                        <div class="dropdown">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
                                class="dropset">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="productlist.html" class="dropdown-item">Product List</a>
                                </li>
                                <li>
                                    <a href="addproduct.html" class="dropdown-item">Product Add</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive dataview">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recent_completed_orders as $item => $recent_order)
                                        <tr>
                                            <td>{{ 1 + $item }}</td>
                                            <td>{{ $recent_order->customer->name }}</td>
                                            <td> <span
                                                    class="badge @if ($recent_order->order_status == 'New') bg-primary @elseif ($recent_order->order_status == 'Processed') bg-warning @elseif ($recent_order->order_status == 'Completed') bg-success @else bg-danger @endif">{{ $recent_order->order_status }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endrole
@role('supervisor')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash1.svg" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            Rp. <span class="counters"
                                data-count="{{ $CashBalance->amount }}">{{ number_format($CashBalance->amount, 0, ',', '.') }}</span>
                        </h5>
                        <h6>Total Cash Balance</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash2.svg" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            Rp.<span class="counters"
                                data-count="{{ $income }}">{{ number_format($income, 0, ',', '.') }}</span>
                        </h5>
                        <h6>Total Income - {{ Carbon\Carbon::now()->isoFormat('MMMM YYYY') }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash4.svg" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            Rp.<span class="counters"
                                data-count="{{ $expense }}">{{ number_format($expense, 0, ',', '.') }}</span>
                        </h5>
                        <h6>Total Expense Amount - {{ Carbon\Carbon::now()->isoFormat('MMMM YYYY') }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img src="assets/img/icons/dash3.svg" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            RP.<span class="counters"
                                data-count="{{ $profit }}">{{ number_format($profit, 0, ',', '.') }}</span>
                        </h5>
                        <h6>Total Profit Amount - {{ Carbon\Carbon::now()->isoFormat('MMMM YYYY') }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>{{ $customer_count }}</h4>
                        <h5>Customers</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4>{{ $order_count }}</h4>
                        <h5>Order</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Purchase & Sales</h5>
                        <div class="graph-sets">
                            <ul>
                                <li>
                                    <span>Sales</span>
                                </li>
                                <li>
                                    <span>Purchase</span>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    2022
                                    <img src="assets/img/icons/dropdown.svg" alt="img" class="ms-2" />
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2020</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sales_charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Recently Order Today</h4>
                        <div class="dropdown">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
                                class="dropset">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="productlist.html" class="dropdown-item">Product List</a>
                                </li>
                                <li>
                                    <a href="addproduct.html" class="dropdown-item">Product Add</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive dataview">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recent_orders as $item => $recent_order)
                                        <tr>
                                            <td>{{ 1 + $item }}</td>
                                            <td>{{ $recent_order->customer->name }}</td>
                                            <td> <span
                                                    class="badge @if ($recent_order->order_status == 'New') bg-primary @elseif ($recent_order->order_status == 'Processed') bg-warning @elseif ($recent_order->order_status == 'Completed') bg-success @else bg-danger @endif">{{ $recent_order->order_status }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endrole

@push('scripts')
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('success', data => {
                // toaster setup
                toastr.options = {
                    "closeButton": true,
                }
                toastr.success(data[0].message);
            });
        });
    </script>
@endpush
