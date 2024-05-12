@role('superadmin')
    @include('livewire.include.administrator-dashboard')
@endrole
@role('supervisor')
    @include('livewire.include.supervisor-dashboard')
@endrole

@push('scripts')
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>
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
    </script>
@endpush
