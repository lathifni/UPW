<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- Title akan dinamis per halaman --}}
    <title>{{ $title ?? 'Dana Sosial UNAND' }}</title>
    <link rel="icon" type="image/x-icon" src="{{ asset('frontend/img/logo_unand.png') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" />

    {{-- Slot untuk CSS tambahan khusus per halaman --}}
    @stack('styles')
</head>

<body>

    <x-partials.navbar />

    <main>
        {{ $slot }}
    </main>

    <x-partials.footer />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarWrapper = document.querySelector('.navbar-wrapper');
            if (navbarWrapper) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbarWrapper.classList.add('scrolled');
                    } else {
                        navbarWrapper.classList.remove('scrolled');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
