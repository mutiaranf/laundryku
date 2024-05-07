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
            <h4>User List</h4>
            <h6>Manage Users</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('user.create') }}" class="btn btn-added" wire:navigate><img
                    src="{{ asset('assets/img/icons/plus.svg') }} "
                    alt="img"/>Add
                User</a>
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
                        <input wire:model.live.debounce="search" type="text" placeholder="Search" class="form-control"/>
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
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img"/></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{ asset('assets/img/icons/excel.svg') }}" alt="img"/></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="{{ asset('assets/img/icons/printer.svg') }}" alt="img"/></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card" id="filter_inputs" wire:ignore>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <input wire:model.live.debounce="nameSearch" type="text" placeholder="Enter User Name"/>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <input wire:model.live.debounce="phoneSearch" type="text"
                                       placeholder="Enter Phone Number"/>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <input wire:model.live.debounce="emailSearch" type="text" placeholder="Enter Email"/>
                            </div>
                        </div>


                        <!-- create option role-->
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group select-group">
                                <select wire:model.live.debounce="roleSearch" class="form-select">
                                    <option value="" style="font-size: 13px; color: #6d6d6d">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
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
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>

                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $key }}</td>
                            <td>
                                <div class="user-img">
                                    @if ($user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                             alt="img" class="rounded-circle"
                                             style="height: 2.5rem; width: 2.5rem; object-fit: cover"/>
                                    @else
                                        <img src="{{ $user->profile_photo_url }}" alt="img"
                                             class="rounded-circle"
                                             style="height: 2.5rem; width: 2.5rem; object-fit: cover"/>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}  @if ($user->status)
                                    <span class="badge bg-success ms-3">Active</span>
                                @else
                                    <span class="badge bg-danger ms-3">Inactive</span>
                                @endif</td>
                            <td>{{ $user->phone }}</td>
                                @foreach ($user->roles as $key => $role)
                                    <td>{{ $role->name }}</td>
                                    @if ($key > 0)
                                        @break
                                    @endif
                                @endforeach

                            <td>
                                <div @if(Auth::user()->id == $user->id) onclick="yourLoggedin()"
                                     @endif
                                     class="status-toggle d-flex justify-content-between align-items-center "
                                     style="margin-right: 20px;"
                                >
                                    <input wire:click="updateStatus({{ $user->id }})" type="checkbox"
                                           id="user{{$user->id}}" class="check"
                                           @if($user->status) checked @endif @if(Auth::user()->id == $user->id) disabled
                                        @endif />
                                    <label for="user{{$user->id}}"
                                           class="checktoggle @if(Auth::user()->id == $user->id) bg-secondary @endif">checkbox</label>
                                </div>
                            </td>
                            <td>
                                <a class="me-3" href="{{ route('user.edit', $user->id) }}">
                                    <img src="{{asset('assets/img/icons/edit.svg')}}" alt="img"/>
                                </a>
                                <a class="me-3 confirm-text" wire:click='delete({{ $user->id }})'>
                                    <img src="{{asset('assets/img/icons/delete.svg')}}" alt="img"/>
                                </a>

                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                <div class="d-flex mt-3">
                    <div class="me-auto">
                        {{ $users->links() }}
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
                toastr.warning('Your Logged in!');
            }

            // hide alrt after 2 seconds
            setTimeout(function () {
                $('.alert').fadeOut('fast');
            }, 3000);


        </script>
@endpush
