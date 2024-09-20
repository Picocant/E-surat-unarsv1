@if (session('swal.error'))
    <script>
        Swal.fire({
            title: "Error!",
            html: "{!! session('swal.error') !!}",
            icon: "error",
            showConfirmButton: false,
            toast: true,
            position: "top",
            timer: 5000,
            timerProgressBar: true,
        })
    </script>
@endif
@if (session('swal.success'))
    <script>
        Swal.fire({
            title: "Sukses!",
            html: "{!! session('swal.success') !!}",
            icon: "success",
            showConfirmButton: false,
            toast: true,
            position: "top",
            timer: 5000,
            timerProgressBar: true,
        })
    </script>
@endif
@if (session('swal.warning'))
    <script>
        Swal.fire({
            title: "Peringatan!",
            html: "{!! session('swal.warning') !!}",
            icon: "warning",
            showConfirmButton: false,
            toast: true,
            position: "top",
            timer: 5000,
            timerProgressBar: true,
        })
    </script>
@endif
@if (session('swal.info'))
    <script>
        Swal.fire({
            title: "Informasi!",
            html: "{!! session('swal.info') !!}",
            icon: "info",
            showConfirmButton: false,
            toast: true,
            position: "top",
            timer: 5000,
            timerProgressBar: true,
        })
    </script>
@endif

@if ($errors->any())
    @php
        $message = collect($errors->all())->map(function ($error) {
            return '<li>' . $error . '</li>';
        });
        $message = '<ul>' . join('', $message->toArray()) . '</ul>';
    @endphp
    <script>
        Swal.fire({
            title: "Error!",
            html: "{!! $message !!}",
            icon: "error",
            showConfirmButton: false,
            toast: true,
            position: "top",
            timer: 5000,
            timerProgressBar: true,
        })
    </script>
@endif

<script>
    window.addEventListener('swal', ({
        detail: {
            type,
            message
        }
    }) => {
        let style = {
            background: "#f6f6f6",
            color: "#000000"
        }
        if (type == 'success') {
            style = {
                background: "green",
                color: '#ffffff',
            }
        } else if (type == 'error') {
            style = {
                background: "red",
                color: '#ffffff',
            }
        } else if (type == 'warning') {
            style = {
                background: "orange",
                color: '#000000',
            }
        }

        Swal.fire({
            title: "Informasi!",
            html: message,
            icon: type,
            showConfirmButton: false,
            toast: true,
            position: "top",
            timer: 5000,
            timerProgressBar: true,
        })
    })
</script>
