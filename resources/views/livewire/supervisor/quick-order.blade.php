@push('styles')

    <link rel="stylesheet" href="{{asset('assets/plugins/toastr/toatr.css')}}"/>
    <style>
        input::placeholder {
            font-size: 15px !important;
        }
    </style>
@endpush
<div class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="card px-3">
                <div class="card-header">
                    <h4 class="card-title
                    ">Pilih Layanan</h4>
                </div>
                <a class="btn btn-primary  mb-5 font-bold" data-bs-toggle="collapse" href="#service" role="button"
                    aria-expanded="false" aria-controls="service">
                    Service
                </a>
                <div class="collapse show" id="service">
                    <div class="card-body">
                        <div class="row">

                            @foreach ($serviceTypes as $serviceType)
                                <div class="col-lg-3">
                                    <div wire:click="addServiceType('{{ $serviceType->name }}', {{ $serviceType->id }},{{ $serviceType->price }},{{ $serviceType->estimated_time }})"
                                        class="card" id="service-card" style="cursor: pointer">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ $serviceType->icon ? asset('storage/' . $serviceType->icon) : asset('assets/img/material-icon/laundry.svg') }}"
                                                    alt="img" height="85" width="85" />
                                            </div>
                                            <div
                                                class="d-flex justify-content-center text-secondary text-bold
                                        ">
                                                <h5>{{ $serviceType->name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
                <a class="btn btn-primary  mb-5 font-bold" data-bs-toggle="collapse" href="#servicePackage"
                    role="button" aria-expanded="false" aria-controls="servicePackage">
                    Service Package
                </a>
                <div class="collapse show" id="servicePackage">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($servicePackages as $servicePackage)
                                <div class="col-lg-3">
                                    <div wire:click="addServicePackage('{{ $servicePackage->name }}', {{ $servicePackage->id }},{{ $servicePackage->price }} ,{{ $servicePackage->estimated_time }})"
                                        class="card" id="service-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ $servicePackage->photo ? asset('storage/' . $servicePackage->photo) : asset('assets/img/material-icon/laundry.svg') }}"
                                                    alt="img" height="85" width="85" />
                                            </div>
                                            <div
                                                class="d-flex justify-content-center text-secondary text-bold
                                        ">
                                                <h5>{{ $servicePackage->name }}</h5>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a class="btn btn-primary  mb-5 font-bold" data-bs-toggle="collapse" href="#laundrySatuan"
                    role="button" aria-expanded="false" aria-controls="laundrySatuan">
                    Laundry Satuan
                </a>
                <div class="collapse show" id="laundrySatuan">
                    <div class="card-body">
                        <div class="row">

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-4">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New Order</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="searchCustomer" class="form-label">Cari Customer</label>
                        <input wire:model='searchTerm' type="text" class="form-control" id="searchCustomer"
                            placeholder="Enter phone number">
                        @error('selectedCustomerId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-flex mb-4">

                        <div class="me-2">
                            <button wire:click='searchCustomerAndShow' class="btn btn-primary"
                                type="button">Cari</button>
                        </div>
                        <div class="me-2">
                            <button wire:click='toggleAddCustomer' class="btn btn-primary" type="button">Tambah
                                Customer</button>
                        </div>
                    </div>
                    @if ($showAddCustomer)
                        <div class="mb-4">
                            <label for="customerName" class="form-label">Name</label>
                            <input wire:model='customerName' type="text" class="form-control" id="customerName"
                                placeholder="name">
                        </div>
                        <div class="mb-4">
                            <label for="customerPhone" class="form-label">Phone</label>
                            <input wire:model='customerPhone' type="text" class="form-control" id="customerPhone"
                                placeholder="phone">
                            @error('customerPhone')
                                @if ($message == 'The phone field is required.')
                                    <span class="text-danger">Nomor telepon tidak boleh kosong</span>
                                @else
                                    <span class="text-danger">Nomor telepon sudah terdaftar</span>
                                @endif

                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="customerAddress" class="form-label">Address</label>
                            <input wire:model='customerAddress' type="text" class="form-control"
                                id="customerAddress" placeholder="address">
                        </div>
                        <div class="mb-4">
                            <label for="customerLatitude" class="form-label">Latitude</label>
                            <input wire:model='customerLatitude' type="text" class="form-control"
                                id="customerLatitude" placeholder="latitude">
                        </div>
                        <div class="mb-4">
                            <label for="customerLongitude" class="form-label">Longitude</label>
                            <input wire:model='customerLongitude' type="text" class="form-control"
                                id="customerLongitude" placeholder="longitude">
                        </div>
                        <div class="mb-4">
                            <button wire:click='addCustomer' class="btn btn-success" type="button">Save &
                                Select</button>
                        </div>
                    @endif

                    @if ($showCustomerInfo)
                        <div class="card mb-4">
                            <div class="card-body d-flex justify-content-between">
                                <h6>{{ $selectedCustomerName }}</h6>
                                <h6>{{ $selectedCustomerPhone }}</h6>
                                <a class="me-3 confirm-text" wire:click='clearSelectedCustomer'>
                                    <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                                </a>
                            </div>

                        </div>
                    @endif
                    @foreach ($selectedServices as $service)
                        <div class=" border rounded border-warning px-3 py-2 mb-3">
                            <div class="row">
                                <div class="col-lg-5">
                                    <p>{{ $service['name'] }}</p>
                                </div>
                                <div class="col-lg-1 d-flex justify-content-center">
                                    <a wire:click="decrementQuantity('{{ $service['name'] }}', {{ $service['id'] }})"
                                        class="badge  btn-primary d-flex justify-content-center align-items-center cursor-pointer">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                </div>
                                <div class="col-lg-1 d-flex justify-content-center">
                                    <p>{{ $service['quantity'] }}</p>
                                </div>
                                <div class="col-lg-1 d-flex justify-content-center">
                                    <a wire:click="incrementQuantity('{{ $service['name'] }}', {{ $service['id'] }})"
                                        class="badge  btn-primary d-flex justify-content-center align-items-center cursor-pointer">
                                        <i class="fa fa-plus
                                "></i>
                                    </a>
                                </div>
                                <div class="col-lg-3 d-flex justify-content-end">
                                    <p>Rp. {{ $service['price'] * $service['quantity'] }},-</p>
                                </div>
                                <div class="col-lg-1 d-flex justify-content-center">
                                    <a wire:click="removeService('{{ $service['name'] }}', {{ $service['id'] }})"
                                        class="badge btn-danger d-flex justify-content-center align-items-center cursor-pointer">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="note" class="form-label">Catatan</label>
                                <textarea wire:model="notes" id="note" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 float-md-right">
                            <div class="total-order">
                                <ul>
                                    @if (count($selectedServices) > 0)
                                        <li>
                                            <h4>Detail Layanan yang Dipilih</h4>



                                        </li>



                                        @foreach ($selectedServices as $service)
                                            <li class="total">
                                                <h4>{{ $service['name'] }} </h4>
                                                <h5> {{ $service['quantity'] }} x Rp.
                                                    {{ number_format($service['price'], 0, ',', '.') }}</h5>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <h4>Tidak ada layanan yang dipilih.</h4>
                                            <h5>-</h5>
                                        </li>
                                    @endif
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5>Rp. <span wire:model='total_amount'>{{ $totalPrice }}</span></h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button wire:click='createOrder'
                                class="btn btn-primary btn-block rounded-pill px-3 py-2 w-100">Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
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
    </script>
@endpush
