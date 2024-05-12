@push('styles')
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/toastr/toatr.css')}}"/>
    <style>
        input::placeholder {
            font-size: 15px !important;
        }
    </style>
@endpush
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Daftar Karyawan</h4>
            <h6>Kelola Karyawan</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('employee.create')}}" class="btn btn-added" wire:navigate><img
                    src="{{ asset('assets/img/icons/plus.svg') }} "
                    alt="img"/>Tambah
                Karyawan</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div wire:ignore class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img"/>
                            <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img"/></span>
                        </a>
                    </div>
                    <div class="search-input me-2">
                        <input wire:model.live.debounce="search" type="text" placeholder="Cari" class="form-control"/>
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
                            src="{{ asset('assets/img/icons/reverse.svg') }}" alt="img"/></a>


                </div>
                <div class="wordset">
                    <ul>

                        <li>
                            <a wire:click='export' data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{ asset('assets/img/icons/excel.svg') }}" alt="img"/></a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="card" id="filter_inputs" wire:ignore>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <input wire:model.live.debounce="emailSearch" type="text"
                                       placeholder="Masukkan Email"/>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <input wire:model.live.debounce="phoneSearch" type="text"
                                       placeholder="Masukkan Nomor Telepon"/>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <select wire:model.live.debounce="outletSearch" class="form-select">
                                    <option>Pilih Outlet</option>
                                    @foreach($outlets as $outlet)
                                        <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <select wire:model.live.debounce="positionSearch" class="form-select">
                                    <option>Pilih Posisi</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                            <div class="form-group">
                                <a wire:click="resetFilter" class="btn btn-filters ms-auto"><img
                                        src="{{ asset('assets/img/icons/reverse.svg') }}" alt="img"/></a>
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
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Outlet</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Tindakan</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $index => $employee)
                        <tr>
                            <td>{{ $employees->firstItem() + $index}}</td>
                            <td>
                                <img src="{{ asset('storage/'.$employee->photo) }}" alt="img"
                                     style="height: 50px; width: 50px; object-fit: cover"/>
                            </td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->gender }}</td>
                            <td>{{ $employee->dob }}</td>
                            <td>{{ $employee->outlet->name }}</td>
                            <td>{{ $employee->position->name }}</td>
                            <td>
                                @if($employee->status == 1)
                                    <span class="badge bg-success">aktif</span>
                                @else
                                    <span class="badge bg-danger">tidak aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href={{ route('employee.edit', $employee->id) }} class="me-2" href="">
                                    <img src="{{asset('assets/img/icons/edit.svg')}}" alt="img"/>
                                </a>
                                <a wire:click="delete({{$employee->id}})" class="me-2 confirm-text">
                                    <img src="{{asset('assets/img/icons/delete.svg')}}" alt="img"/>
                                </a>
                                <a wire:click="show({{$employee->id}})" class="me-2 confirm-text" data-bs-toggle="modal"
                                   data-bs-target="#showOutletModal">
                                    <img src="{{asset('assets/img/icons/eye.svg')}}" alt="img"/>
                                </a>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
                    <div class="d-flex mt-3">
                        <div class="me-auto">
                            {{ $employees->links() }}
                        </div>
                    </div>


            </div>
        </div>
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="showOutletModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{asset('/storage/'.$photo)}}" width="250" height="350">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Nama</td>
                                    <td>{{$name}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Email</td>
                                    <td>{{$email}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Nomor Telepon</td>
                                    <td>{{$phone}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Jenis Kelamin</td>
                                    <td>{{$gender}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Tanggal Lahir
                                    </td>
                                    <td>{{$dob}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Nomor Rekening
                                    </td>
                                    <td>{{$account_number}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Alamat</td>
                                    <td>{{$address}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Gaji</td>
                                    <td>{{$salary}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Outlet</td>
                                    <td>{{$outlet_name}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold !important; color: black !important;">Posisi</td>
                                    <td>{{$position_name}}</td>
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

            // create alert
            function yourLoggedin() {
                toastr.warning('Anda Telah Masuk!');
            }

            // hide alrt after 2 seconds
            setTimeout(function () {
                $('.alert').fadeOut('fast');
            }, 3000);


        </script>
@endpush
