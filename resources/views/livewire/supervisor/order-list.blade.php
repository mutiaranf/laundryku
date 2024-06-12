@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toatr.css') }}"/>
    <style>
        input::placeholder {
            font-size: 15px !important;
        }
    </style>
@endpush
<div class="content">
    <div class="card">
        <div class="card-body">
            <h4 class=" mb-3" style="font-weight: 600">Daftar Pesanan</h4>

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
        setTimeout(function () {
            $('.alert').fadeOut('fast');
        }, 3000);
    </script>
@endpush
