<script src="{{ asset('sweet-js') }}"></script>
<script>
    Swal.fire({
        position: 'center',
        icon: 'info',
        title: '{{$slot}}',
        showConfirmButton: true,
    });
</script>