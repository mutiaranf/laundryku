@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"/>
@endpush
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Employee Management</h4>
            <h6>Add/Update Employee</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form wire:submit='store' enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Employee Name</label>
                            <input wire:model="name" type="text"/>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input wire:model="email" type="text"/>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input wire:model="phone" type="text"/>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Choose Outlet</label>
                            <select  wire:model="outlet_id" class="form-control">
                                <option>Choose Outlet</option>
                                @foreach($outlets as $outlet)
                                    <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                @endforeach
                            </select>
                            @error('outlet_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Position</label>
                            <select  wire:model="position_id" class="form-control">
                                <option>Choose Position</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            @error('position_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input wire:model="address" type="text"/>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="form-group">
                            <label>Gender</label>
                            <select wire:model="gender" class="form-control">
                                <option>Choose Gender</option>
                                <option value="laki-laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group
                        ">
                            <label>Salary</label>
                            <input wire:model="salary" type="text"/>
                            @error('salary')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group
                        ">
                            <label>Status</label>
                            <select wire:model="status" class="form-control">
                                <option>Choose Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group
                        ">
                            <label>Account Number</label>
                            <input wire:model="account_number" type="text"/>
                            @error('account_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group
                        ">
                            <label>Date of Birth</label>
                            <input wire:model="dob" type="date" class="form-control"/>
                            @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div class="form-group
                        ">
                            <label>Photo</label>
                            <input wire:model="photo" type="file" class="form-control"/>
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12 d-flex justify-content-center align-items-center">
                        @if($photo)
                            <img class="mt-3 rounded-circle img-thumbnail" src="{{ $photo->temporaryUrl() }}" alt="img"
                                 style="height: 330px; width: 330px; object-fit: cover"/>

                        @else
                            <img class="mt-3 rounded-circle img-thumbnail"
                                 src="{{ asset('assets/img/profiles/Default_pfp.svg') }}" alt="img"
                                 style="height: 330px; width: 330px; object-fit: cover"/>
                        @endif
                    </div>


                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2"
                        >Submit</button
                        >
                        <a href="javascript:history.back();" class="btn btn-cancel"
                        >Cancel</a
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

