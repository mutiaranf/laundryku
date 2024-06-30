<div class="content">
    <div class="card">
        <div class="card-body">

            <div class="mb-5">
                <div class="form">

                    <div class="d-flex mb-3">
                        <label for="day">
                            <h6>Harian</h6>
                        </label>
                    </div>
                    <div class="row">
                        <div wire:model='date_day_from' class="col-lg-6"><label for="exampleInputEmail1"
                                class="form-label">Dari</label>
                            <input type="date" class="form-control">
                        </div>
                        <div wire:model='date_day_to' class="col-lg-6"> <label for="exampleInputEmail1"
                                class="form-label">Sampai</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex">
                        <a wire:click='printPdfOrderReportDay' class="btn btn-danger mt-3 me-2">Cetak PDF</a>
                        {{-- <button wire:click='printExcelOrderReportDay' class="btn btn-success mt-3 me-2">Cetak
                            EXCEL</button> --}}
                    </div>
                </div>
            </div>
            <div class="mb-5 ">
                <div class="d-flex mb-3">


                    <label for="month">
                        <h6>Bulanan</h6>
                    </label>
                </div>
                <div class="row">
                    <div class="col-lg-6"><label for="exampleInputEmail1" class="form-label">Dari</label>
                        <input wire:model='date_month_from' type="month" class="form-control">
                    </div>
                    <div class="col-lg-6"> <label for="exampleInputEmail1" class="form-label">Sampai</label>
                        <input wire:model='date_month_to' type="month" class="form-control">
                    </div>
                </div>
                <div class="d-flex">
                    <button wire:click='printPdfOrderReportMonth' class="btn btn-danger mt-3 me-2">Cetak PDF</button>
                    {{-- <button wire:click='printExcelOrderReportMonth' class="btn btn-success mt-3 me-2">Cetak
                        EXCEL</button> --}}

                </div>
            </div>
            <div class="mb-5 ">
                <div class="d-flex mb-3">
                    <label for="year">
                        <h6>Tahunan</h6>
                    </label>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <input wire:model='date_year' class="form-control" type="number" min="1900" max="2099"
                            step="1" value="2024" />
                    </div>

                </div>
                <div class="d-flex">
                    <button wire:click='printPdfOrderReportYear' class="btn btn-danger mt-3 me-2">Cetak PDF</button>
                    {{-- <button wire:click='printExcelOrderReportYear' class="btn btn-success mt-3 me-2">Cetak
                        EXCEL</button> --}}

                </div>
            </div>

        </div>
    </div>
</div>
</label>
