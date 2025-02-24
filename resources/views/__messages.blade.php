    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (Session::has('success'))
            Swal.fire({
                icon: 'success',
                html: '<p>{{ Session::get('success') }}</p>',
            })
        @endif


        @if (count($errors) > 0)

            Swal.fire({
                icon: 'error',
                html: '<p>@if (is_object($errors)) @foreach ($errors->all() as $error) {{ $error }}<br/> @endforeach @endif</p>',
            })
        @endif
    </script>
