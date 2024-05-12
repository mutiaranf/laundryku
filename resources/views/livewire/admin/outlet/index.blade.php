@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toatr.css') }}" />
    <style>
        input::placeholder {
            font-size: 15px !important;
        }
    </style>
@endpush
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Daftar Outlet</h4>
            <h6>Kelola Outlet</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('outlet.create') }}" class="btn btn-added" wire:navigate><img
                    src="{{ asset('assets/img/icons/plus.svg') }} " alt="img" />Tambah
                Outlet</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div wire:ignore class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img" />
                            <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img" /></span>
                        </a>
                    </div>
                    <div class="search-input me-2">
                        <input wire:model.live.debounce="search" type="text" placeholder="Cari"
                            class="form-control" />
                    </div>
                    <!-- per page -->
                    <div class="per-page me-2">
                        <select wire:model.live.debounce="perPage" class="form-select">
                            <option checked>5</option>
                            <option>10</option>
                            <option>20</option>
                            <option>30</option>
                            <option>40</option>
                            <option>50</option>
                        </select>
                    </div>
                    <a wire:click="resetFilter" class="btn btn-sm btn-primary ms-auto"><img
                            src="{{ asset('assets/img/icons/reverse.svg') }}" alt="img" /></a>


                </div>
                <div class="wordset">
                    <ul>

                        <li>
                            <a wire:click='export' data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{ asset('assets/img/icons/excel.svg') }}" alt="img" /></a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="card" id="filter_inputs" wire:ignore>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <input wire:model.live.debounce="addressSearch" type="text"
                                    placeholder="Masukkan alamat" />
                            </div>
                        </div>

                        <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                            <div class="form-group">
                                <a wire:click="resetFilter" class="btn btn-filters ms-auto"><img
                                        src="{{ asset('assets/img/icons/reverse.svg') }}" alt="img" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                @if (session('success'))
                    <div class="alert alert-success" style="width: 30%">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Lintang</th>
                            <th>Bujur</th>
                            <th>Status</th>
                            <th>Tindakan</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($outlets as $index => $outlet)
                            <tr>
                                <td>{{ $outlets->firstItem() + $index }}</td>
                                <td>
                                    <div class="user-img">
                                        @if ($outlet->photo)
                                            <img src="{{ asset('storage/' . $outlet->photo) }}" alt="img"
                                                class="img-thumbnail"
                                                style="height: 3rem; width: 5rem; object-fit: cover" />
                                        @else
                                            <img src="{{ asset('assets/img/default_image.png') }}" alt="img"
                                                class="img-thumbnail"
                                                style="height: 3rem; width: 5rem; object-fit: cover" />
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $outlet->name }}</td>
                                <td>{{ $outlet->phone }}</td>
                                <td>{{ $outlet->address }}</td>
                                <td>{{ $outlet->latitude }}</td>
                                <td>{{ $outlet->longitude }}</td>
                                <td>
                                    @if ($outlet->status == 1)
                                        <span class="badge bg-success">Buka</span>
                                    @else
                                        <span class="badge bg-danger">Tutup</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="me-2" href="{{ route('outlet.edit', $outlet->id) }}">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                                    </a>
                                    <a wire:click="delete({{ $outlet->id }})" class="me-2 confirm-text">
                                        <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                                    </a>
                                    <a wire:click="show({{ $outlet->id }})" class="me-2 confirm-text"
                                        data-bs-toggle="modal" data-bs-target="#showOutletModal">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" />
                                    </a>
                                    <a wire:click="showFinanceOutlet({{ $outlet->id }})" class="me-2 confirm-text"
                                        data-bs-toggle="modal" data-bs-target="#showOutletModal">
                                        <img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img" />
                                    </a>


                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex mt-3">
                    <div class="me-auto">
                        {{ $outlets->links() }}
                    </div>
                </div>


            </div>


        </div>

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="showOutletModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($detailOutletModal)
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group
                                ">
                                        <label>Nama Outlet</label>
                                        <input type="text" class="form-control" value="{{ $name }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group
                                ">
                                        <label>Telepon</label>
                                        <input type="text" class="form-control" value="{{ $phone }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group
                                ">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" value="{{ $address }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group
                                ">
                                        <label>Lintang</label>
                                        <input type="text" class="form-control" value="{{ $latitude }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group
                                ">
                                        <label>Bujur</label>
                                        <input type="text" class="form-control" value="{{ $longitude }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group
                                ">
                                        <label>Mulai Operasi</label>
                                        <input type="text" class="form-control" value="{{ $start_operation }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group
                                ">
                                        <label>Akhir Operasi</label>
                                        <input type="text" class="form-control" value="{{ $end_operation }}0"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group
                                ">
                                        <label>Status</label>
                                        <input type="text" class="form-control"
                                            value="{{ $status == 0 ? 'Tutup' : 'Buka' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <img class="mt-3  img-thumbnail" src="{{ asset('storage/' . $photo) }}"
                                        alt="img" style="width: 100%; object-fit: cover" />
                                </div>

                            </div>
                        @elseif($financialOutletModal)
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="dash-widget">
                                        <div class="dash-widgetimg">
                                            <span><img src="assets/img/icons/dash1.svg" alt="img" /></span>
                                        </div>
                                        <div class="dash-widgetcontent">
                                            <h5>
                                                Rp. <span class="counters"
                                                    data-count="{{ $cashBalance }}">{{ number_format($cashBalance, 0, ',', '.') }}</span>
                                            </h5>
                                            <h6>Total Saldo Tunai</h6>
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
                                            <h6>Total Pendapatan - {{ Carbon\Carbon::now()->isoFormat('MMMM YYYY') }}</h6>
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
                                            <h6>Total Jumlah Pengeluaran -
                                                {{ Carbon\Carbon::now()->isoFormat('MMMM YYYY') }}
                                            </h6>
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
                                            <h6>Total Jumlah Keuntungan -
                                                {{ Carbon\Carbon::now()->isoFormat('MMMM YYYY') }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-12 d-flex">
                                    <div class="dash-count">
                                        <div class="dash-counts">
                                            <h4>{{ $customer_count }}</h4>
                                            <h5>Pelanggan</h5>
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
                                            <h5>Pesanan</h5>
                                        </div>
                                        <div class="dash-imgs">
                                            <i data-feather="file"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="table-responsive">

                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bulan</th>
                                        <th>Completed</th>
                                        <th>Processed</th>
                                        <th>Cancelled</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($ordersRecap != null)
                                        @foreach ($ordersRecap as $index => $data)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $data->month }}</td>
                                                <td>{{ $data->completed }}</td>
                                                <td>{{ $data->processed }}</td>
                                                <td>{{ $data->cancelled }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                            <div class="d-flex mt-3">
                                <div class="me-auto">
                                    {{ $outlets->links() }}
                                </div>
                            </div>


                        </div>



                    </div>
                </div>
            </div>



        </div>

        @push('scripts')
            <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
            <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>
            <script>
                Livewire.on('success', data => {
                    // toaster setup
                    toastr.options = {
                        "closeButton": true,
                    }
                    toastr.success(data[0].message);
                });

                // create alert
                function yourLoggedin() {
                    toastr.warning('Anda Telah Masuk!');
                }

                // hide alrt after 2 seconds
                setTimeout(function() {
                    $('.alert').fadeOut('fast');
                }, 3000);
            </script>
        @endpush
