@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toatr.css') }}" />
    <style>
        input::placeholder {
            font-size: 15px !important;
        }
    </style>
@endpush
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Transaksi Pengeluaran</h4>
            <h6>Manajemen Pengelolaan Transaksi</h6>
        </div>
        <div class="page-btn">
            <a data-bs-toggle="modal" data-bs-target="#addExpenseModal" class="btn btn-added"><img
                    src="{{ asset('assets/img/icons/plus.svg') }} " alt="img" />Add
                Expense</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">

                    <div class="search-input me-2">
                        <input wire:model.live.debounce="searchST" type="text" placeholder="Search"
                            class="form-control" />
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
                            src="{{ asset('assets/img/icons/reverse.svg') }}" alt="img" /></a>


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
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pengeluaran</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $index => $expense )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $expense->name }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>{{ $expense->expense_date }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>
                                    <a wire:click="destroy({{ $expense->id }})"

                                        ><img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" /></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex mt-3">
                    <div class="me-auto">
                        {{ $expenses->links() }}
                    </div>
                </div>


            </div>
        </div>

        <!-- Modal Stock Type-->
        <div wire:ignore.self class="modal fade" id="addExpenseModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="store">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group
                                  ">
                                        <label>Nama</label>
                                        <input wire:model='name' type="text" class="form-control">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group
                                  ">
                                        <label>Jumlah</label>
                                        <input wire:model='amount' type="text" class="form-control">
                                        @error('amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group
                                  ">
                                        <label>Tanggal Pengeluaran</label>
                                        <input wire:model='expense_date' type="date" class="form-control">
                                        @error('expense_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="form-group
                                  ">
                                        <label>Deskripsi</label>
                                        <textarea wire:model='description' class="form-control"></textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <!-- checking action store or update -->
                                        <button type="submit" class="btn btn-submit me-2">Submit</button>

                                    <a data-bs-dismiss="modal" wire:click="resetForm"
                                        class="btn btn-cancel">Cancel</a>
                                </div>


                            </div>
                        </form>

                    </div>
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
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 3000);

        window.addEventListener('success', event => {
            console.log("Modal hide code executed");
            $('.modal').modal('hide');
        });
    </script>
@endpush
