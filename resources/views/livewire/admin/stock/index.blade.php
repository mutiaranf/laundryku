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
            <h4>Stock Type</h4>
            <h6>Manage Stock Type</h6>
        </div>
        <div class="page-btn">
            <a data-bs-toggle="modal" data-bs-target="#addServiceTypeModal" class="btn btn-added"><img
                    src="{{ asset('assets/img/icons/plus.svg') }} "
                    alt="img"/>Add
                Stock Type</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">

                    <div class="search-input me-2">
                        <input wire:model.live.debounce="searchST" type="text" placeholder="Search"
                               class="form-control"/>
                    </div>
                    <!-- per page -->
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
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stockCategories as $index => $stockCategory)
                        <tr>
                            <td>{{ $stockCategories->firstItem() + $index }}</td>

                            <td>{{ $stockCategory->name }}</td>
                            <td>{{ $stockCategory->unit }}</td>
                            <td>{{ $stockCategory->description }}</td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#addServiceTypeModal"
                                   wire:click="editSC({{ $stockCategory->id }})" class="btn btn-edit"><img
                                        src="{{ asset('assets/img/icons/edit.svg') }}" alt="img"/></a>
                                <a wire:click="deleteSC({{ $stockCategory->id }})" class="btn btn-delete"><img
                                        src="{{ asset('assets/img/icons/delete.svg') }}" alt="img"/></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="d-flex mt-3">
                    <div class="me-auto">
                        {{ $stockCategories->links() }}
                    </div>
                </div>


            </div>
        </div>


    </div>

    <div class="page-header">
        <div class="page-title">
            <h4>Stock List</h4>
            <h6>Manage Stoks</h6>
        </div>

        <div class="page-btn">
            <a data-bs-toggle="modal" data-bs-target="#addStockModal" class="btn btn-added"><img
                    src="{{ asset('assets/img/icons/plus.svg') }} "
                    alt="img"/>Add
                Stocks</a>
        </div>

    </div>

    <div class="card">

        <div class="card-body">
            <div class="table-top">
                <div class="search-set">

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
                    <div class="me-2">
                        <select wire:model="outlet_filter" class="form-select">
                            @foreach($outlets as $outlet)
                                <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                            @endforeach
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
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Initial Qty</th>
                        <th>Current Qty</th>
                        <th>Total Price</th>
                        <th>Minimum Qty</th>
                        <th>Unit</th>
                        <th>Date</th>
                        <th>Actions</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stocks as $index => $stock)
                        <tr>
                            <td>{{ $stocks->firstItem() + $index }}</td>
                            <td>{{ $stock->name }}</td>
                            <td>{{ \Illuminate\Support\Number::currency($stock->price,'IDR')  }}</td>
                            <td><span class="badge bg-success">{{ round($stock->initial_quantity) }}</span></td>
                            <td><span
                                    class="badge {{ $stock->current_quantity <= 0 ? 'bg-danger' : ($stock->current_quantity <= $stock->minimum_quantity ? 'bg-warning' : 'bg-success')}}">{{ round($stock->current_quantity) }}</span>
                            </td>
                            <td>{{ \Illuminate\Support\Number::currency($stock->total_price,'IDR')  }}</td>
                            <td><span class="badge bg-success">{{ round($stock->minimum_quantity) }}</span></td>
                            <td> {{ $stock->category->unit }}</td>
                            <td>{{ $stock->created_at->diffForHumans()}} </td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#addStockModal"
                                   wire:click="editS({{ $stock->id }})" class="btn btn-edit"><img
                                        src="{{ asset('assets/img/icons/edit.svg') }}" alt="img"/></a>
                                <a wire:click="deleteS({{ $stock->id }})" class="btn btn-delete"><img
                                        src="{{ asset('assets/img/icons/delete.svg') }}" alt="img"/></a>
                            </td>
                            <td>
                                <div class="d-flex ">
                                    <input wire:model="stock_number" type="number" class="form-control-sm me-2"
                                           style="width: 80px !important;">
                                    <button wire:click="addStock({{$stock->id}})" class="btn btn-sm btn-primary me-2">
                                        <img src="{{asset('assets/img/material-icon/add.svg')}}" alt="" srcset="">
                                    </button>
                                    <button wire:click="reduceStock({{$stock->id}})" class="btn btn-sm btn-danger"><img
                                            src="{{asset('assets/img/material-icon/min.svg')}}" alt="" srcset="">
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex mt-3">
                    <div class="me-auto">

                    </div>
                </div>


            </div>
        </div>
        <!-- Modal Stock Type-->
        <div wire:ignore.self class="modal fade" id="addServiceTypeModal" tabindex="-1"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Service Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="storeSC">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group
                                ">
                                        <label>Name</label>
                                        <input wire:model='nameSC' type="text" class="form-control">
                                        @error('nameSC')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group
                                ">
                                        <label>Unit</label>
                                        <input wire:model='unit' type="text" class="form-control">
                                        @error('unit')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group
                                ">
                                        <label>Description</label>
                                        <textarea wire:model='descriptionSC' class="form-control"></textarea>
                                        @error('descriptionSC')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <!-- checking action store or update -->
                                    @if($edit_modeSC)
                                        <button wire:click="updateSC" class="btn btn-submit me-2">Update</button>
                                    @else

                                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                                    @endif
                                    <a data-bs-dismiss="modal" wire:click="resetFormSC"
                                       class="btn btn-cancel">Cancel</a>
                                </div>


                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <!-- Modal Stock -->
        <div wire:ignore.self class="modal fade" id="addStockModal" tabindex="-1"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="storeS">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input wire:model='nameS' type="text" class="form-control">
                                        @error('nameS')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Outlet </label>
                                        <select wire:model="outlet_id" id="" class="form-control">
                                            <option value="">Select Outlet</option>
                                            @foreach($outlets as $outlet)
                                                <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('outlet_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Category </label>
                                        <select wire:model="category_id" id="" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($stock_categories as $stock_category)
                                                <option value="{{ $stock_category->id }}">{{ $stock_category->name }}
                                                    ( {{$stock_category->unit}} )
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Initial Quantity</label>
                                        <input id="initial_qty" wire:model='initial_quantity' type="number"
                                               class="form-control">
                                        @error('initial_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Current Quantity</label>
                                        <input wire:model="current_quantity" id="current_qty" type="text"
                                               class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input id="price" wire:model='price' type="number" class="form-control">
                                        @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Minimum Quantity</label>
                                        <input wire:model='minimum_quantity' type="number" class="form-control">
                                        @error('minimum_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Total Price</label>
                                        <input wire:model="total_price" id="total_price" type="number"
                                               class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input wire:model='photo' type="file" class="form-control">
                                        @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                    @if($photo)
                                        <img src="{{ $photo->temporaryUrl() }}" alt=""
                                             style="height: 300px; ">
                                    @else
                                        <img src="{{ asset('storage/') }}" alt=""
                                             style="height: 300px; ">
                                    @endif
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <!-- checking action store or update -->
                                    @if($edit_modeS)
                                        <button wire:click="updateS" class="btn btn-submit me-2">Update</button>
                                    @else
                                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                                    @endif
                                    <a data-bs-dismiss="modal" wire:click="resetFormS"
                                       class="btn btn-cancel">Cancel</a>
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
                toastr.warning('Your Logged in!');
            }

            // hide alrt after 2 seconds
            setTimeout(function () {
                $('.alert').fadeOut('fast');
            }, 3000);

            window.addEventListener('success', event => {
                console.log("Modal hide code executed");
                $('.modal').modal('hide');
            });

            document.getElementById('initial_qty').addEventListener('input', calculateTotalPrice)
            document.getElementById('price').addEventListener('input', calculateTotalPrice)
            document.getElementById('initial_qty').addEventListener('input', function () {
                document.getElementById('current_qty').value = document.getElementById('initial_qty').value
            })

            function calculateTotalPrice() {
                let price = document.getElementById('price').value;
                let initial_qty = document.getElementById('initial_qty').value;
                document.getElementById('total_price').value = price * initial_qty;
            }
        </script>
@endpush
