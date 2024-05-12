@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"/>
@endpush
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Pengelolaan Pengguna</h4>
            <h6>Tambah/Perbarui Pengguna</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form  wire:submit='store' enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Pengguna</label>
                            <input wire:model='name' type="text" required/>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input wire:model='email' type="text" required/>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kata Sandi</label>
                            <div class="pass-group">
                                <input wire:model='password' type="password" class="pass-input" required/>
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Telepon</label>
                            <input wire:model='phone' type="text" required/>
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div wire:ignore class="form-group">
                            <label>Peran</label>
                            <select wire:model='user_role' class="select" required>
                                <option value="" selected>Pilih</option>
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('user_role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Kata Sandi</label>
                            <div class="pass-group">
                                <input wire:model='password_confirmation' type="password" class="pass-inputs" required/>
                                <span class="fas toggle-passworda fa-eye-slash"></span>
                            </div>
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class=" col-sm-6 col-12">
                        <label for="">Foto</label>
                        <div class="form-group d-flex flex-column align-items-center">
                            <input wire:model='profile_photo_path' class="form-control" type="file" accept="image/*"  name=""
                                   id="">
                            @if($profile_photo_path)
                                <img class="mt-3 rounded-circle img-thumbnail"
                                     src="{{ $profile_photo_path->temporaryUrl() }}" alt="img"
                                     style="height: 330px; width: 330px; object-fit: cover"/>
                            @else
                                <img class="mt-3 rounded-circle img-thumbnail" src="{{ asset('assets/img/profiles/Default_pfp.svg') }}" alt="img"
                                     style="height: 330px; width: 330px; object-fit: cover"/>
                            @endif
                        </div>
                        @error('profile_photo_path')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror


                    </div>
                    <div class="col-lg-12">
                        <!-- memeriksa tindakan simpan atau perbarui-->
                        <button type="submit"  class="btn btn-submit me-2">Kirim</button>
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
