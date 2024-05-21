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
            <h4>Daftar Posisi</h4>
            <h6>Kelola Posisi</h6>
        </div>
        <div class="page-btn">
            <a data-bs-toggle="modal" data-bs-target="#addPositionModal" class="btn btn-added"><img
                    src="{{ asset('assets/img/icons/plus.svg') }} "
                    alt="img"/>Tambah
                Posisi</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">

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

            </div>

            <div class="card" id="filter_inputs" wire:ignore>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <input wire:model.live.debounce="nameSearch" type="text" placeholder="Masukkan Nama Pengguna"/>
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
                                <input wire:model.live.debounce="emailSearch" type="text" placeholder="Masukkan Email"/>
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
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Tindakan</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($positions as $index => $position)
                        <tr>
                            <td>{{ $positions->firstItem()+ $index }}</td>
                            <td>{{ $position->name }}</td>
                            <td>{{ $position->description }}</td>
                            <td>
                                <a class="me-2" wire:click="edit({{$position->id}})" data-bs-toggle="modal" data-bs-target="#addPositionModal" >
                                    <img src="{{asset('assets/img/icons/edit.svg')}}" alt="img"/>
                                </a>
                                <a wire:click="delete({{$position->id}})" class="me-2 confirm-text">
                                    <img src="{{asset('assets/img/icons/delete.svg')}}" alt="img"/>
                                </a>


                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                    <div class="d-flex mt-3">
                        <div class="me-auto">
                            {{ $positions->links() }}
                        </div>
                    </div>


            </div>


        </div>
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Posisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="store">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group
                                ">
                                        <label>Nama</label>
                                        <input wire:model='name' type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group
                                ">
                                        <label>Deskripsi</label>
                                        <textarea wire:model='description' class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <!-- checking action store or update -->
                                    @if($edit_mode)
                                        <button data-bs-dismiss="modal" wire:click="update({{$id}})" class="btn btn-submit me-2">Perbarui</button>
                                    @else

                                    <button data-bs-dismiss="modal" type="submit" class="btn btn-submit me-2">Kirim</button>
                                    @endif
                                    <a data-bs-dismiss="modal" class="btn btn-cancel">Batal</a>
                                </div>


                            </div>
                        </form>

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
                toastr.warning('Anda Telah Masuk!');
            }

            // hide alrt after 2 seconds
            setTimeout(function () {
                $('.alert').fadeOut('fast');
            }, 3000);


        </script>
@endpush
