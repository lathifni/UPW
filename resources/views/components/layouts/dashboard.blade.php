<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Dashboard' }} - Dana Sosial UNAND</title>
    <link rel="icon" type="image/x-icon" src="{{ asset('frontend/img/logo_unand.png') }}">

    {{-- Aset CSS Global --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- CSS Khusus untuk semua halaman Dashboard --}}
    <style>
        .dashboard-hero {
            background: linear-gradient(135deg, rgba(25, 135, 84, 0.9) 0%, rgba(32, 201, 151, 0.9) 100%);
            color: white;
            padding: 60px 0 40px;
            position: relative;
            overflow: hidden;
        }

        .dashboard-hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.05"><polygon points="1000,100 1000,0 0,100"/></svg>');
            background-size: cover;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .user-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 4px;
        }

        .dashboard-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .sidebar {
            position: sticky;
            top: 100px;
        }

        .nav-pills .nav-link {
            color: #6c757d;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link:hover {
            background: linear-gradient(135deg, #198754, #20c997);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(25, 135, 84, 0.3);
        }

        .nav-pills .nav-link:hover:not(.active) {
            background: #f8f9fa;
            color: #198754;
            box-shadow: none;
        }

        .stats-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(25, 135, 84, 0.1), rgba(32, 201, 151, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: #198754;
            font-size: 1.5rem;
        }

        .chart-container {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
        }

        .donation-item {
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 0;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            margin: 0 -0.5rem;
            padding: 1rem 0.5rem;
        }

        .donation-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .donation-item:last-child {
            border-bottom: none;
        }
    </style>
    @stack('styles')
</head>

<body>
    <x-partials.navbar />

    <section class="dashboard-hero">
        <div class="container">
            {{ $hero_content }}
        </div>
    </section>

    <section class="dashboard-content py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <x-partials.dashboard-sidebar />
                </div>
                <div class="col-lg-9">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </section>

    <x-partials.footer />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    {{-- 2. Skrip untuk notifikasi ERROR (setelah aksi) --}}
    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    {{-- 3. Skrip untuk notifikasi ERROR VALIDASI (setelah submit form) --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Oops, terjadi kesalahan!',
                html: `{!! implode('<br>', $errors->all()) !!}`, // Menampilkan semua error validasi
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            })
        </script>
    @endif

    {{-- 4. Skrip untuk konfirmasi SEBELUM AKSI (contoh: hapus) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Tindakan ini tidak dapat dibatalkan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, lanjutkan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
