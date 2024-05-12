<div class="content">
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash1.svg" alt="img"/></span>
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
                    <span><img src="assets/img/icons/dash2.svg" alt="img"/></span>
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
                    <span><img src="assets/img/icons/dash4.svg" alt="img"/></span>
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
                    <span><img src="assets/img/icons/dash3.svg" alt="img"/></span>
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

        <div class="col-lg-12 col-sm-12 col-12 d-flex">
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
                        <div class="d-flex mt-3">
                            <div class="me-auto">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
