<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Order PDF Export By Day</title>
</head>

<body>

    <div class="text-center">

        <img src="{{ asset('assets/img/laundry.png') }}" alt="logo" style="width: 100px; height: 100px">
        <h3>
            <b style="text-transform: uppercase">LaundryKu</b></br>
        </h3>
        <span style='font-size:12pt'>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('LL') }} -
            {{ \Carbon\Carbon::now()->locale('id')->isoFormat('LT') }}

            <br><br><br>
            <h4>Laporan Order</h4><br>
            <div class="container">

                <table class="table  table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Nama Pelanggan</th>
                            <th>Outlet</th>
                            <th>Status</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders->isEmpty())

                            <tr>
                                <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
                            </tr>
                        @else
                            @foreach ($orders as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->customer->name }}</td>
                                    <td>{{ $data->outlet->name }}</td>
                                    <td>{{ $data->order_status }}</td>
                                    <td>
                                        @php
                                            $totalPrice = 0;
                                            foreach ($data->detailOrder as $key => $value) {
                                                $totalPrice += $value->total_price;
                                            }
                                            echo $totalPrice;
                                        @endphp
                                    </td>
                                    <td>{{ date_format($data->created_at, 'd/m/Y') }}</td>
                                </tr>
                            @endforeach
                            <tr>

                            </tr>
                            <th colspan="5" class="text-end font-bold">Total :</th>
                            <th>
                                @php
                                    $totalPrice = 0;
                                    foreach ($orders as $key => $value) {
                                        foreach ($value->detailOrder as $key => $detail) {
                                            $totalPrice += $detail->total_price;
                                        }
                                    }
                                    echo $totalPrice;
                                @endphp
                            </th>
                            </tr>
                        @endif

                    </tbody>
                </table>

                <div class="row mt-5">
                    <div class="col-12 d-flex align-items-end justify-content-end">
                        <div>

                            <p>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('LL') }} <br> Mengetahui, <br>
                                @if (Auth::user()->hasRole('superadmin'))
                                    Admin
                                @elseif (Auth::user()->hasRole('supervisor'))
                                    Supervisor
                                @endif
                            </p>

                            <br><br><br>
                            <p><b>{{ Auth::user()->name }}</b></p>
                        </div>

                    </div>
                </div>
            </div>
    </div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
    <script>
        window.print();
    </script>
</body>

</html>
