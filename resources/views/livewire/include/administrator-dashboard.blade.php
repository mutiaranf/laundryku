<div class="content">

    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash1.svg" alt="img"/></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        Rp. <span class=""
                                  data-count="{{ $totalCashBalance }}">{{ number_format($totalCashBalance, 0, ',', '.') }},-</span>
                    </h5>
                    <h6>Total Saldo Kas </h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash1">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash2.svg" alt="img"/></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        Rp. <span class=""
                                  data-count="{{ $totalIncome }}">{{ number_format($totalIncome, 0, ',', '.') }},-</span>
                    </h5>
                    <h6>Total Pendapatan</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash2">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash3.svg" alt="img"/></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        Rp. <span class=""
                                  data-count="{{ $totalProfit }}">{{ number_format($totalProfit, 0, ',', '.') }},-</span>
                    </h5>
                    <h6>Total Keuntungan</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash3">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash4.svg" alt="img"/></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        Rp. <span class=""
                                  data-count="{{ $totalExpense }}">{{ number_format($totalExpense, 0, ',', '.') }},-</span>
                    </h5>
                    <h6>Total Pengeluaran</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>{{ $totalCustomerCount }}</h4>
                    <h5>Total Pelanggan</h5>
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
                    <h5>Total Karyawan</h5>
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
                    <h5>Total Pesanan</h5>
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

                <div class="card-body">
                    <div id="chart-admin"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Pesanan Terbaru</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive dataview">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class=" mb-3" style="font-weight: 600">Pesanan bulan ini</h4>
                    <div class="table-responsive">
                        <table class="table mt-3">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th>Pelanggan</th>
                                <th>Waktu Estimasi</th>
                                <th>Status Order</th>
                                <th>Harga</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $item => $order)
                                <tr>
                                    <td>{{ $orders->firstItem() + $item }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->estimated_completion_time }}</td>
                                    <td> <span
                                            class="badge @if ($order->order_status == 'New') bg-primary @elseif ($order->order_status == 'Processed') bg-warning @elseif ($order->order_status == 'Completed') bg-success @else bg-danger @endif">{{ $order->order_status }}</span>
                                    </td>
                                    <td>Rp.{{ number_format($order->getTotalPriceAttribute(), 0, ',', '.') }},-</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex mt-3">
                            <div class="me-auto">
                                {{$orders->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
