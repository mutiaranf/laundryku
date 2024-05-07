@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"/>
@endpush
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>User Management</h4>
            <h6>Add/Update User</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form  wire:submit='update' enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>User Name</label>
                            <input wire:model='name' type="text"/>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input wire:model='email' type="text"/>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="pass-group">
                                <input wire:model='password' type="password" class="pass-input"/>
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input wire:model='phone' type="text"/>
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div wire:ignore class="form-group">
                            <label>Role</label>
                            <select wire:model='user_role' class="select">
                                <option>Select</option>
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <div class="pass-group">
                                <input wire:model='password_confirmation' type="password" class="pass-inputs"/>
                                <span class="fas toggle-passworda fa-eye-slash"></span>
                            </div>
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class=" col-sm-6 col-12">
                        <label for="">Photo</label>
                        <div class="form-group d-flex flex-column align-items-center">
                            <input wire:model='profile_photo_path' class="form-control" type="file" accept="image/*"  name=""
                                   id="">
                            @if($profile_photo_path)
                                <img class="mt-3 rounded-circle img-thumbnail"
                                     src="{{ $profile_photo_path->temporaryUrl() }}" alt="img"
                                     style="height: 330px; width: 330px; object-fit: cover"/>
                            @else
                                <img class="mt-3 rounded-circle img-thumbnail" src="{{ $profile_photo_path == null ? "$profile_photo_url" : asset('storage/'.$old_photo) }}" alt="img"
                                     style="height: 330px; width: 330px; object-fit: cover"/>
                            @endif
                        </div>
                        @error('profile_photo_path')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror


                    </div>
                    <div class="col-lg-12">
                        <!-- checking action store or update-->
                        <button type="submit"  class="btn btn-submit me-2">Submit</button>
                        <a href="javascript:history.back()" class="btn btn-cancel">Cancel</a>
                    </div>
                    <div wire:loading class="mt-3">
                        Saving....
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
