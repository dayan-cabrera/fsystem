<script src="{{ asset('sweet-js') }}"></script>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '{{$slot}}',
            showConfirmButton: true,
        });
    </script>