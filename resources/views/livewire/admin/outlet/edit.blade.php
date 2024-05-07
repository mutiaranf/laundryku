@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"/>
@endpush
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Outlet Edit</h4>
            <h6>Update Outlet</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form wire:submit="update" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Outlet Name</label>
                            <input wire:model="name" type="text"/>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input wire:model="address" type="text"/>
                            @error('address')
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
                            <label>Start Operation</label>
                            <input wire:model="start_operation" class="form-control" type="time"/>
                            @error('start_operation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>End Operation</label>
                            <input wire:model="end_operation" class="form-control" type="time"/>
                            @error('end_operation')
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
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Cash Balance</label>
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
                                <option value="" selected>Select</option>
                                <option value="0" >Closed</option>
                                <option value="1">Open</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label for="">Photo</label>
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
                        <!-- checking action store or update-->
                        <button type="submit" class="btn btn-submit me-2">Submit</button>
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
