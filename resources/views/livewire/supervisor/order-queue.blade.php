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
    <div class="card">
        <div class="card-body">
            <h4 class=" mb-3" style="font-weight: 600">Antrian Pesanan Hari Ini</h4>
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>{{ $order_queue_count }}</h4>
                            <h5>Antrian</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>{{ $order_completed_count }}</h4>
                            <h5>Completed</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user-check"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das2">
                        <div class="dash-counts">
                            <h4>{{ $customer_count }}</h4>
                            <h5>Pelanggan</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das3">
                        <div class="dash-counts">
                            <h4>{{ $order_queue_count + $order_completed_count }}</h4>
                            <h5>Total Order</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file"></i>
                        </div>
                    </div>
                </div>

            </div>
            <div class="table-responsive">
                <h4 class=" mb-3" style="font-weight: 600">Antrian Pesanan bulan ini</h4>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Pelanggan</th>
                            <th>Waktu Estimasi</th>
                            <th>Status Order</th>
                            <th>Harga</th>
                            <th>Aksi</th>
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
                                <td>
                                    <a wire:click="show({{ $order->id }})" class="me-2 confirm-text"
                                        data-bs-toggle="modal" data-bs-target="#showOrderModal">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" />
                                    </a>
                                    <a wire:click="changeStatus({{ $order->id }}, 'Cancelled')"
                                        class="me-2 confirm-text">
                                        <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                                    </a>
                                    @if($order->order_status == 'Completed')

                                    <a
                                    href="{{ route('print-struct', $order->id) }}"
                                        class="me-2 confirm-text">
                                        <img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img" />
                                    </a>
                                    @endif
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

    <div wire:ignore.self class="modal fade" id="showOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Order</h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Nama Pelanggan
                                    </td>
                                    <td>{{ $customer_name }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Waktu Estimasi
                                    </td>
                                    <td>{{ $estimated_time }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Status Order</td>
                                    <td><span
                                            class="badge @if ($order_status == 'New') bg-primary @elseif ($order_status == 'Processed') bg-warning @elseif ($order_status == 'Completed') bg-success @else bg-danger @endif">{{ $order_status }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Catatan</td>
                                    <td>{{ $note }}</td>
                                </tr>

                                @for ($i = 0; $i < count($services); $i++)
                                    <tr>
                                        <td style="font-weight: bold !important; color: black !important;">
                                            {{ $services[$i]['service_name'] }}</td>
                                        <td>
                                            Qty : {{ $services[$i]['quantity'] }} | Harga :
                                            {{ $services[$i]['price'] }} | Total : {{ $services[$i]['total_price'] }}
                                            <br>
                                        </td>
                                    </tr>
                                @endfor

                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Total Harga</td>
                                    <td>{{ $total_price }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center mt-3">
                                        <button data-bs-dismiss="modal"
                                            wire:click="changeStatus({{ $order_id }}, 'Processed')"
                                            class="btn btn-warning text-white">Set to Processed</button>
                                        <button data-bs-dismiss="modal"
                                            wire:click="changeStatus({{ $order_id }}, 'Completed')"
                                            class="btn btn-success text-white">Set to Completed</button>
                                        <button data-bs-dismiss="modal"
                                            wire:click="changeStatus({{ $order_id }}, 'Cancelled')"
                                            class="btn btn-danger text-white">Set to Cancelled</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

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
        Livewire.on('error', data => {
            // toaster setup
            toastr.options = {
                "closeButton": true,
            }
            toastr.error(data[0].message);
        });


        // create alert
        function yourLoggedin() {
            toastr.warning('Your Logged in!');
        }

        // hide alrt after 2 seconds
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 3000);
    </script>
@endpush
