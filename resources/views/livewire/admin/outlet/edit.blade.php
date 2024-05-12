@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"/>
@endpush
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Outlet</h4>
            <h6>Perbarui Outlet</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form wire:submit="update" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Outlet</label>
                            <input wire:model="name" type="text"/>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input wire:model="address" type="text"/>
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input wire:model="phone" type="text"/>
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Jam Mulai Operasi</label>
                            <input wire:model="start_operation" class="form-control" type="time"/>
                            @error('start_operation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Jam Selesai Operasi</label>
                            <input wire:model="end_operation" class="form-control" type="time"/>
                            @error('end_operation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Lintang</label>
                            <input wire:model="latitude" type="text"/>
                            @error('latitude')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Bujur</label>
                            <input wire:model="longitude" type="text"/>
                            @error('longitude')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Saldo Tunai</label>
                            <input wire:model="cashBalance" type="number" class="form-control"/>
                            @error('cashBalance')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group" >
                            <label>Status</label>
                            <select  wire:model="status" class="form-control">
                                <option value="" selected>Pilih</option>
                                <option value="0" >Tutup</option>
                                <option value="1">Buka</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label for="">Foto</label>
                        <div class="form-group d-flex flex-column align-items-center">
                            <input wire:model='photo' class="form-control" type="file" accept="image/*"
                                   name=""
                                   id="">
                        </div>
                        @if($photo)
                            <img class="mt-3  img-thumbnail"
                                 src="{{ $photo->temporaryUrl() }}" alt="img"
                                 style=" width: 100%; object-fit: cover"/>
                        @else
                            <img class="mt-3  img-thumbnail"
                                 src="{{ asset('storage/'.$old_photo) }}" alt="img"
                                 style="width: 100%; object-fit: cover"/>
                        @endif
                        @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror


                    </div>
                    <div class="col-lg-12 mt-3">
                        <!-- memeriksa aksi simpan atau perbarui-->
                        <button type="submit" class="btn btn-submit me-2">Kirim</button>
                        <a href="javascript:history.back()" class="btn btn-cancel">Batal</a>
                    </div>
                    <div wire:loading class="mt-3">
                        Menyimpan....
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileupload/fileupload.min.js') }}"></script>
@endpush
