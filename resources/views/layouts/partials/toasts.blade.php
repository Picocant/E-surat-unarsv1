@if (session('toast.error'))
    <script>
        Toastify({
            text: "{!! session('toast.error') !!}",
            duration: 5000,
            close: true,
            gravity: "top",
            position: "center",
            stopOnFocus: true,
            style: {
                background: "red",
                color: '#ffffff',
            },
        }).showToast();
    </script>
@endif

@if (session('toast.warning'))
    <script>
        Toastify({
            text: "{!! session('toast.warning') !!}",
            duration: 5000,
            close: true,
            gravity: "top",
            position: "center",
            stopOnFocus: true,
            style: {
                background: "orange",
                color: '#000000',
            },
        }).showToast();
    </script>
@endif

@if (session('toast.success'))
    <script>
        Toastify({
            text: "{!! session('toast.success') !!}",
            duration: 5000,
            close: true,
            gravity: "top",
            position: "center",
            stopOnFocus: true,
            style: {
                background: "green",
                color: '#ffffff',
            },
        }).showToast();
    </script>
@endif

@if (session('toast.info'))
    <script>
        Toastify({
            text: "{!! session('toast.info') !!}",
            duration: 5000,
            close: true,
            gravity: "top",
            position: "center",
            stopOnFocus: true,
            style: {
                background: "#f6f6f6",
                color: '#000000',
            },
        }).showToast();
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            Toastify({
                text: "{!! $error !!}",
                duration: 5000,
                close: true,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "red",
                    color: '#ffffff',
                },
            }).showToast();
        </script>
    @endforeach
@endif

<script>
    window.addEventListener('toast', ({
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

        Toastify({
            text: message,
            duration: 5000,
            close: true,
            gravity: "top",
            position: "center",
            stopOnFocus: true,
            style: style,
        }).showToast()
    })
</script>
