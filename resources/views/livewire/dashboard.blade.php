@role('superadmin')
    @include('livewire.include.administrator-dashboard')
@endrole
@role('supervisor')
    @include('livewire.include.supervisor-dashboard')
@endrole

@push('scripts')
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('success', data => {
                // toaster setup
                toastr.options = {
                    "closeButton": true,
                }
                toastr.success(data[0].message);
            });
        });

        var options = {
            series: [{
                name: 'Completed',
                data: {!! json_encode($grafikStatusCompletedAdmin) !!}
            }, {
                name: 'Cancelled',
                data: {!! json_encode($grafikStatusCancelledAdmin) !!}
            }],
            chart: {
                height: 350,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'month',
                categories:  {!! json_encode($grafikMonthAdmin) !!}
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };
        var chart = new ApexCharts(document.querySelector("#chart-admin"), options);
        chart.render();
    </script>
@endpush
