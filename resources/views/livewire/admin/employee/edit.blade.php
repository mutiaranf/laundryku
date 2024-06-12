@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
@endpush
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Manajemen Karyawan</h4>
            <h6>Perbarui Karyawan</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form wire:submit='update' enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <input wire:model="name" type="text" />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input wire:model="email" type="text" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Telepon</label>
                            <input wire:model="phone" type="text" />
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Pilih Outlet</label>
                            <select wire:model="outlet_id" class="form-control">
                                <option>Pilih Outlet</option>
                                <option value="{{ $outlet_id }}" selected>{{ $outlet }}</option>
                                @foreach ($outlets as $outlet)
                                    @if($outlet->id != $outlet_id)
                                        <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('outlet_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Posisi</label>
                            <select wire:model="position_id" class="form-control">
                                <option>Pilih Posisi</option>
                                <option value="{{ $position_id }}" selected>{{ $position }}</option>
                                @foreach ($positions as $position)
                                    @if($position->id != $position_id)

                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('position_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input wire:model="address" type="text" />
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select wire:model="gender" class="form-control">
                                <option>Pilih Jenis Kelamin</option>
                                <option value="{{ $gender }}" selected>{{ $gender == 'laki-laki' ? 'Laki-laki' : 'Perempuan'}}</option>
                                <option value="{{ $gender == 'perempuan' ? 'laki-laki' : 'perempuan' }}">{{ $gender == 'perempuan' ? 'Laki-laki' : 'Perempuan' }}</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Gaji</label>
                            <input wire:model="salary" type="text" />
                            @error('salary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select wire:model="status" class="form-control">
                                <option>Pilih Status</option>
                                <option value="{{ $status }}" selected> {{ $status == 0 ? 'Tidak Aktif' : 'Aktif' }}</option>
                                <option value="{{ $status == 0 ?  : 0 }}">{{ $status == 1 ? 'Tidak Aktif' : 'Aktif' }}</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nomor Rekening</label>
                            <input wire:model="account_number" type="text" />
                            @error('account_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input wire:model="dob" type="date" class="form-control" />
                            @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Foto</label>
                            <input wire:model="photo" type="file" class="form-control" />
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12 d-flex justify-content-center align-items-center">
                        @if ($oldPhoto)
                            @if ($photo)
                                <img class="mt-3 rounded-circle img-thumbnail" src="{{ $photo->temporaryUrl() }}"
                                    alt="img" style="height: 330px; width: 330px; object-fit: cover" />
                            @else
                                <img class="mt-3 rounded-circle img-thumbnail" src="{{ asset('storage/'.$oldPhoto) }}"
                                    alt="img" style="height: 330px; width: 330px; object-fit: cover" />
                            @endif
                        @else
                            <img class="mt-3 rounded-circle img-thumbnail"
                                src="{{ asset('assets/img/profiles/Default_pfp.svg') }}" alt="img"
                                style="height: 330px; width: 330px; object-fit: cover" />
                        @endif
                    </div>


                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Kirim</button>
                        <a href="javascript:history.back();" class="btn btn-cancel">Batal</a>
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
