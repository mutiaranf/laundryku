@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"/>
@endpush
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Manajemen Pelanggan</h4>
            <h6>Tambah/Perbarui Pelanggan</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form wire:submit='store' enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input wire:model="name" type="text"/>
                            @error('name')
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
                            <label>Latitude</label>
                            <input wire:model="latitude" type="text"/>
                            @error('latitude')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Longitude</label>
                            <input wire:model="longitude" type="text"/>
                            @error('longitude')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input wire:model="address" type="text"/>

                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2"
                        >Kirim</button
                        >
                        <a href="javascript:history.back();" class="btn btn-cancel"
                        >Batal</a
                        >
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

