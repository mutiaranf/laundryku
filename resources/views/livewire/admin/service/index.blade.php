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
            <h4>Jenis Layanan</h4>
            <h6>Kelola Jenis Layanan</h6>
        </div>
        <div class="page-btn">
            <a data-bs-toggle="modal" data-bs-target="#addServiceTypeModal" class="btn btn-added"><img
                    src="{{ asset('assets/img/icons/plus.svg') }} "
                    alt="img"/>Tambah
                Jenis Layanan</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">

                    <div class="search-input me-2">
                        <input wire:model.live.debounce="searchST" type="text" placeholder="Cari"
                               class="form-control"/>
                    </div>
                    <!-- per halaman -->
                    <div class="per-page me-2">
                        <select wire:model.live.debounce="perPageST" class="form-select">
                            <option checked>5</option>
                            <option>10</option>
                            <option>20</option>
                            <option>30</option>
                            <option>40</option>
                            <option>50</option>
                        </select>
                    </div>
                    <a wire:click="resetFilterST" class="btn btn-sm btn-primary ms-auto"><img
                            src="{{ asset('assets/img/icons/reverse.svg') }}" alt="img"/></a>


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
                        <th>Icon</th>
                        <th>Nama</th>
                        <th>Waktu Estimasi</th>
                        <th>Harga</th>
                        <th>Unit</th>
                        <th>Deskripsi</th>
                        <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($serviceTypes as $index => $serviceType)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src="{{ $serviceType->icon ? asset('storage/'.$serviceType->icon) : asset('assets/img/material-icon/laundry.svg') }}" alt="" srcset=""
                                     style="height: 45px; width: 45px;"></td>
                            <td>{{ $serviceType->name }}</td>
                            <td>{{ $serviceType->estimated_time }}</td>
                            <td>{{ $serviceType->price }}</td>
                            <td>{{ $serviceType->unit }}</td>
                            <td>{{ $serviceType->description }}</td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#addServiceTypeModal"
                                   wire:click="editST({{ $serviceType->id }})" class="btn btn-edit"><img
                                        src="{{ asset('assets/img/icons/edit.svg') }}" alt="img"/></a>
                                <a wire:click="deleteST({{ $serviceType->id }})" class="btn btn-delete"><img
                                        src="{{ asset('assets/img/icons/delete.svg') }}" alt="img"/></a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                <div class="d-flex mt-3">
                    <div class="me-auto">
                        {{ $serviceTypes->links() }}
                    </div>
                </div>


            </div>
        </div>


    </div>
    @if($show_formSP)
        <div class="card p-4">
            <form wire:submit="storeSP">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group
                                ">
                            <label>Nama</label>
                            <input wire:model='nameSP' type="text" class="form-control">
                            @error('nameSP')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group
                                ">
                            <label>Harga</label>
                            <input wire:model='priceSP' type="number" class="form-control">
                            @error('priceSP')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group
                                ">
                            <label>Waktu Estimasi (Dalam Jam)</label>
                            <input wire:model='estimated_timeSP' type="number" class="form-control">
                            @error('estimated_timeSP')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group
                                ">
                            <label>Jenis Layanan</label>
                            <select wire:model="service_types_id" id="" class="form-control">
                                <option value="">Pilih Jenis Layanan</option>
                                @foreach($serviceTypes as $serviceType)
                                    <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                                @endforeach
                            </select>

                            @error('service_types_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="form-group
                                ">
                            <label>Foto</label>
                            <input wire:model='photoSP' type="file" class="form-control">
                            @error('photoSP')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-2 d-flex justify-content-center align-items-center">

                        @if($photoSP)
                            <img src="{{ $photoSP->temporaryUrl() }}" alt="" style="height: 50px; width: 50px;">
                        @else
                            <img src="{{ asset('storage/'.$oldPhotoSP) }}" alt="" style="height: 50px; width: 50px;">
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group
                                ">
                            <label>Deskripsi</label>
                            <textarea wire:model='descriptionSP' class="form-control"></textarea>
                            @error('descriptionSP')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 mt-3">
                        <!-- memeriksa tindakan simpan atau perbarui -->
                        @if($edit_modeSP)
                            <button wire:click="updateSP({{$idSP}})" class="btn btn-submit me-2">Perbarui</button>
                        @else

                            <button type="submit" class="btn btn-submit me-2">Kirim</button>
                        @endif
                        <a wire:click="closeFormSP" class="btn btn-cancel">Batal</a>
                    </div>


                </div>
            </form>
        </div>
    @endif
    <div class="page-header">
        <div class="page-title">
            <h4>Daftar Paket Layanan</h4>
            <h6>Kelola Paket Layanan</h6>
        </div>
        @if(!$show_formSP)
            <div class="page-btn">
                <a wire:click="showFormSP" class="btn btn-added"><img
                        src="{{ asset('assets/img/icons/plus.svg') }} "
                        alt="img"/>Tambah
                    Paket Layanan</a>
            </div>
        @endif
    </div>

    <div class="card">

        <div class="card-body">
            <div class="table-top">
                <div class="search-set">

                    <div class="search-input me-2">
                        <input wire:model.live.debounce="search" type="text" placeholder="Cari" class="form-control"/>
                    </div>
                    <!-- per halaman -->
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
                    <a wire:click="resetFilterSP" class="btn btn-sm btn-primary ms-auto"><img
                            src="{{ asset('assets/img/icons/reverse.svg') }}" alt="img"/></a>


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
                        <th>Harga</th>
                        <th>Waktu Estimasi</th>
                        <th>Jenis Layanan</th>
                        <th>Deskripsi</th>
                        <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($servicePackages as $index => $servicePackage)
                        <tr>
                            <td>{{ $servicePackages->firstItem() + $index }}</td>
                            <td><img src="{{ $servicePackage->photo ? asset('storage/'.$servicePackage->photo) : asset('assets/img/material-icon/laundry.svg') }}" alt="" srcset=""
                                     style="height: 45px; width: 45px;"></td>
                            <td>{{ $servicePackage->name }}</td>
                            <td>{{ $servicePackage->price }}</td>
                            <td>{{ $servicePackage->estimated_time }}</td>
                            @foreach($serviceTypes as $serviceType)
                                @if($serviceType->id == $servicePackage->service_types_id)
                                    <td>{{ $serviceType->name }}</td>
                                @endif
                            @endforeach
                            <td>{{ $servicePackage->description }}</td>
                            <td>
                                <a wire:click="editSP({{ $servicePackage->id }})" class="btn btn-edit"><img
                                        src="{{ asset('assets/img/icons/edit.svg') }}" alt="img"/></a>
                                <a wire:click="deleteSP({{ $servicePackage->id }})" class="btn btn-delete"><img
                                        src="{{ asset('assets/img/icons/delete.svg') }}" alt="img"/></a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex mt-3">
                    <div class="me-auto">
                        {{ $servicePackages->links() }}
                    </div>
                </div>


            </div>
        </div>
        <!-- Modal Jenis Layanan-->
        <div wire:ignore.self class="modal fade" id="addServiceTypeModal" tabindex="-1"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Layanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="storeST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group
                                ">
                                        <label>Nama</label>
                                        <input wire:model='nameST' type="text" class="form-control">
                                        @error('nameST')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group
                                ">
                                        <label>Harga</label>
                                        <input wire:model='priceST' type="number" class="form-control">
                                        @error('priceST')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group
                                ">
                                        <label>Unit</label>
                                        <input wire:model='unitST' type="text" class="form-control">
                                        @error('unitST')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group
                                ">
                                        <label>Waktu Estimasi (Dalam Jam)</label>
                                        <input wire:model='estimated_timeST' type="number" class="form-control">
                                        @error('estimated_timeST')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group
                                ">
                                        <label>Icon</label>
                                        <input wire:model='iconST' type="file" class="form-control">
                                        @error('iconST')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex justify-content-center align-items-center">

                                    @if($iconST)
                                        <img src="{{ $iconST->temporaryUrl() }}" alt=""
                                             style="height: 50px; width: 50px;">
                                    @else
                                        <img src="{{ asset('storage/'.$oldIconST) }}" alt=""
                                             style="height: 50px; width: 50px;">
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group
                                ">
                                        <label>Deskripsi</label>
                                        <textarea wire:model='descriptionST' class="form-control"></textarea>
                                        @error('descriptionST')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <!-- memeriksa tindakan simpan atau perbarui -->
                                    @if($edit_modeST)
                                        <button wire:click="updateST({{$idST}})" class="btn btn-submit me-2">Perbarui
                                        </button>
                                    @else

                                        <button type="submit" class="btn btn-submit me-2">Kirim</button>
                                    @endif
                                    <a data-bs-dismiss="modal" wire:click="resetFormST"
                                       class="btn btn-cancel">Batal</a>
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

            // create alert
            function yourLoggedin() {
                toastr.warning('Anda Telah Masuk!');
            }

            // sembunyikan alert setelah 2 detik
            setTimeout(function () {
                $('.alert').fadeOut('fast');
            }, 3000);

            window.addEventListener('success', event => {
                console.log("Kode sembunyikan modal dijalankan");
                $('.modal').modal('hide');
            });

        </script>
@endpush
