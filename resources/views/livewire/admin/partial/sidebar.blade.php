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
                            style="color: #1B2850; font-size: 12px; font-weight: 700">Data Master</h6>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/users1.svg') }} "
                                alt="img" /><span>
                                Pengguna</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('user*') ? 'active' : '' }}" href="{{ route('user') }}">Manajemen Pengguna</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/material-icon/position.svg') }} "
                                alt="img" /><span>
                                Posisi</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('position*') ? 'active' : '' }}"
                                    href="{{ route('position') }}">Manajemen Posisi</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/material-icon/outlet.svg') }} "
                                alt="img" /><span>
                                Outlet</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('outlet*') ? 'active' : '' }}"
                                    href="{{ route('outlet') }}">Manajemen Outlet</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/users1.svg') }} "
                                alt="img" /><span>
                                Karyawan</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('employee*') ? 'active' : '' }}"
                                    href="{{ route('employee') }}">Manajemen Karyawan</a></li>

                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/material-icon/customer.svg') }} "
                                alt="img" /><span>
                                Pelanggan</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('customer*') ? 'active' : '' }}"
                                    href="{{ route('customer') }}">Manajemen Pelanggan</a></li>

                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/material-icon/service.svg') }} "
                                alt="img" /><span>
                                Layanan</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('service*') ? 'active' : '' }}"
                                    href="{{ route('service') }}">Manajemen Layanan</a></li>
                        </ul>

                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/product.svg') }} "
                                alt="img" /><span>
                                Stok</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('stock*') ? 'active' : '' }}"
                                    href="{{ route('stock') }}">Manajemen Stok</a></li>

                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/printer.svg') }} "
                                alt="img" /><span>
                                Laporan</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="{{ Request::routeIs('report*') ? 'active' : '' }}"
                                    href="{{ route('report') }}">Cetak Laporan</a></li>

                        </ul>
                    </li>

                @endrole

                @role('supervisor')
                    <li class="mb-3">
                        <a href="{{ route('quick-order') }} "
                            class="{{ Request::routeIs('quick-order*') ? 'active' : '' }}"><img
                                src="{{ asset('assets/img/material-icon/laundry.svg') }} " alt="img" /><span>
                                Pesanan Cepat
                            </span>
                        </a>
                    </li>
                    <li>
                        <h6 class="category text-secondary text-uppercase ms-3 text-bold"
                            style="color: #1B2850; font-size: 12px; font-weight: 700">Transaksi</h6>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/material-icon/cart.svg') }} "
                                alt="img" /><span>
                                Pesanan</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('order-queue') }}"
                                    class="{{ Request::routeIs('order-queue*') ? 'active' : '' }}">Antrian
                                    Pesanan</a></li>
                            <li><a class="{{ Request::routeIs('order-list*') ? 'active' : '' }}" href="{{ route('order-list') }}">Daftar Pesanan</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/expense1.svg') }} "
                                alt="img" /><span>
                                Pengeluaran</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('expense') }}"
                                    class="{{ Request::routeIs('expense*') ? 'active' : '' }}">Daftar
                                    Pengeluaran</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/product.svg') }} "
                                alt="img" /><span>
                                Stok</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('stockOutlet') }}" class="{{ Request::routeIs('stockOutlet*') ? 'active' : '' }}">Daftar
                                    Stok</a></li>
                        </ul>
                    </li>
                    {{-- <li class="submenu">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/transfer1.svg') }} "
                                alt="img" /><span>
                                Transaksi</span>
                            <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="">Daftar Transaksi</a></li>
                        </ul>
                    </li>
                    --}}

                @endrole

            </ul>
        </div>
    </div>
</div>
