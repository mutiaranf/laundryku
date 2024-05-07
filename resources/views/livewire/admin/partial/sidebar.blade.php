<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }} mb-3">
                    <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/img/icons/dashboard.svg') }} "
                            alt="img" /><span>
                            Dashboard</span>
                    </a>
                </li>
                @role('superadmin')
                    <li>
                        <h6 class="category text-secondary text-uppercase ms-3 text-bold"
                            style="color: #1B2850; font-size: 12px; font-weight: 700">Master Data</h6>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/users1.svg') }} "
                                alt="img" /><span>
                                Users</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('user*') ? 'active' : '' }}" href="{{ route('user') }}">Users
                                    Management</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/material-icon/position.svg') }} "
                                alt="img" /><span>
                                Positions</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('position*') ? 'active' : '' }}"
                                    href="{{ route('position') }}">Positions
                                    Management</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/material-icon/outlet.svg') }} "
                                alt="img" /><span>
                                Outlets</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('outlet*') ? 'active' : '' }}"
                                    href="{{ route('outlet') }}">Outlets
                                    Management</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/users1.svg') }} "
                                alt="img" /><span>
                                Employees</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('employee*') ? 'active' : '' }}"
                                    href="{{ route('employee') }}">Employees Management</a></li>
                            <li><a href="#">Attendance</a></li>
                            <li><a href="#">Payroll</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/material-icon/customer.svg') }} "
                                alt="img" /><span>
                                Customers</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('customer*') ? 'active' : '' }}"
                                    href="{{ route('customer') }}">Custumers Management</a></li>

                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/material-icon/service.svg') }} "
                                alt="img" /><span>
                                Services</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('service*') ? 'active' : '' }}"
                                    href="{{ route('service') }}">Service Management</a></li>
                        </ul>

                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/product.svg') }} "
                                alt="img" /><span>
                                Stock</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('stock*') ? 'active' : '' }}"
                                    href="{{ route('stock') }}">Stock Management</a></li>
                            <li><a href="#">Category List</a></li>
                            <li><a href="#">Brand List</a></li>
                            <li><a href="#">Print Barcode</a></li>
                        </ul>
                    </li>

                @endrole

                @role('supervisor')
                    <li class="mb-3">
                        <a href="{{ route('quick-order') }} "
                            class="{{ Request::routeIs('quick-order*') ? 'active' : '' }}"><img
                                src="{{ asset('assets/img/material-icon/laundry.svg') }} " alt="img" /><span>
                                Quick Order
                            </span>
                        </a>
                    </li>
                    <li>
                        <h6 class="category text-secondary text-uppercase ms-3 text-bold"
                            style="color: #1B2850; font-size: 12px; font-weight: 700">Transaction</h6>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/material-icon/cart.svg') }} "
                                alt="img" /><span>
                                Orders</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('order-queue') }}"
                                    class="{{ Request::routeIs('order-queue*') ? 'active' : '' }}">Order
                                    Queue</a></li>
                            <li><a href="">Order
                                    List</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/expense1.svg') }} "
                                alt="img" /><span>
                                Expenses</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('expense') }}"
                                    class="{{ Request::routeIs('expense*') ? 'active' : '' }}">Expense
                                    List</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/product.svg') }} "
                                alt="img" /><span>
                                Stock</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('stockOutlet') }}" class="{{ Request::routeIs('stockOutlet*') ? 'active' : '' }}">Stock
                                    List</a></li>
                        </ul>
                    </li>
                    {{-- <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/transfer1.svg') }} "
                                alt="img" /><span>
                                Transactions</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="">Transaction
                                    List</a></li>
                        </ul>
                    </li>
                    --}}

                @endrole

            </ul>
        </div>
    </div>
</div>
