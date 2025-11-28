<x-layouts.dashboard>
    <x-slot:title>Dashboard Overview</x-slot:title>

    {{-- Mengisi slot 'hero_content' yang ada di layout dashboard --}}
    <x-slot:hero_content>
        <div class="user-profile" style="padding-top: 70px;">
            <img src="{{ Auth::user()->avatar ? asset('storage/avatars/' . Auth::user()->avatar) : 'https://via.placeholder.com/90x90/198754/ffffff?text=' . substr(Auth::user()->nama, 0, 1) }}"
                alt="{{ Auth::user()->nama }}" class="user-avatar" />
            <div class="user-info">
                <h1 class="h3 mb-1 fw-bold">Halo, {{ Auth::user()->nama }}!</h1>
                <p class="mb-2 opacity-90">Terima kasih telah menjadi bagian dari perubahan melalui donasi Anda.</p>
            </div>
        </div>
    </x-slot:hero_content>

    @push('styles')
        {{-- CSS Tambahan Khusus untuk halaman ini --}}
        <style>
            .stats-card small {
                font-size: 0.8rem;
            }

            .program-card .card-body {
                padding: 1.5rem;
            }

            .update-item {
                border-left: 3px solid #198754;
                padding-left: 1rem;
                margin-bottom: 1.5rem;
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

            .quick-action {
                background: white;
                border-radius: 1rem;
                padding: 1.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                border: 2px solid transparent;
                text-align: center;
                transition: all 0.3s ease;
                height: 100%;
                text-decoration: none;
                color: inherit;
                display: block;
            }

            .quick-action:hover {
                transform: translateY(-3px);
                border-color: #198754;
                box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.1);
                color: inherit;
            }

            .quick-action-icon {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg,
                        rgba(25, 135, 84, 0.1),
                        rgba(32, 201, 151, 0.1));
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                color: #198754;
                font-size: 1.5rem;
                transition: all 0.3s ease;
            }

            .quick-action:hover .quick-action-icon {
                background: linear-gradient(135deg, #198754, #20c997);
                color: white;
                transform: scale(1.1);
            }

            .update-item {
                border-left: 3px solid #198754;
                padding-left: 1rem;
                margin-bottom: 1.5rem;
                transition: all 0.3s ease;
            }

            .update-item:hover {
                border-left-color: #20c997;
                transform: translateX(5px);
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="stats-card text-center">
                <div class="stats-icon mx-auto"><i class="bi bi-cash-coin"></i></div>
                <h3 class="text-success mb-2">Rp {{ number_format($total_donation, 0, ',', '.') }}</h3>
                <p class="text-muted mb-0">Total Donasi</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card text-center">
                <div class="stats-icon mx-auto"><i class="bi bi-heart"></i></div>
                <h3 class="text-success mb-2">{{ $supported_programs_count }}</h3>
                <p class="text-muted mb-0">Program Didukung</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card text-center">
                <div class="stats-icon mx-auto"><i class="bi bi-clock-history"></i></div>
                <h3 class="text-success mb-2">{{ $total_transactions }}</h3>
                <p class="text-muted mb-0">Donasi Berhasil</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stats-card text-center">
                <div class="stats-icon mx-auto"><i class="bi bi-award"></i></div>
                <h3 class="text-success mb-2">0</h3> {{-- TODO: Buat ini dinamis dari data sertifikat --}}
                <p class="text-muted mb-0">Sertifikat</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="chart-container">
                <h5 class="mb-3">Aktivitas Donasi {{ date('Y') }}</h5>
                <canvas id="donationChart" height="250"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="chart-container">
                <h5 class="mb-3">Distribusi Donasi</h5>
                <canvas id="distributionChart" height="250"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Donasi Terbaru</h5>
                    <a href="#" class="btn btn-outline-success btn-sm">Lihat Semua</a>
                </div>
                <div class="donation-list">
                    @forelse ($recent_donations as $donation)
                        <div class="donation-item">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6 class="mb-1">{{ $donation->program->title ?? 'Nama Program' }}</h6>
                                    <small class="text-muted">{{ $donation->created_at->format('d M Y, H:i') }}
                                        WIB</small>
                                </div>
                                <div class="col-sm-3">
                                    <strong class="text-success">Rp
                                        {{ number_format($donation->amount, 0, ',', '.') }}</strong>
                                </div>
                                <div class="col-sm-3 text-sm-end">
                                    @if ($donation->status == 'paid')
                                        <span class="badge bg-success">Berhasil</span>
                                    @elseif($donation->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>@else<span
                                            class="badge bg-danger">Gagal</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted my-4">Anda belum memiliki riwayat donasi.</p>
                    @endforelse
                </div>
            </div>

            <div class="dashboard-card">
                <h5 class="mb-3">Program yang Didukung</h5>
                <div class="row g-3">
                    @forelse($supported_programs as $program)
                        <div class="col-md-6">
                            <div class="program-card card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="card-title mb-0">{{ Str::limit($program->title, 25) }}</h6>
                                        <span
                                            class="badge bg-{{ $program->is_active ? 'success' : 'secondary' }}">{{ $program->is_active ? 'Aktif' : 'Selesai' }}</span>
                                    </div>
                                    <p class="card-text small text-muted mb-3">
                                        {{ Str::limit($program->description, 50) }}</p>
                                    <div class="program-progress mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <small class="text-muted">Progress</small>
                                            <small class="text-muted">{{ $program->progres_persentase }}%</small>
                                        </div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $program->progres_persentase }}%"></div>
                                        </div>
                                    </div>
                                    <a href="{{ route('programs.show.public', $program->id) }}"
                                        class="btn btn-outline-success btn-sm w-100">Lihat Program</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted text-center">Anda belum mendukung program apa pun.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card mb-4">
                <h5 class="mb-3">Aksi Cepat</h5>
                <div class="row g-3">
                    <div class="col-6"><a href="{{ route('programs.index.public') }}"
                            class="quick-action text-center">
                            <div class="quick-action-icon"><i class="bi bi-plus-circle"></i></div>
                            <h6 class="mb-0 mt-2">Donasi Baru</h6>
                        </a></div>
                    <div class="col-6"><a href="#" class="quick-action text-center">
                            <div class="quick-action-icon"><i class="bi bi-award"></i></div>
                            <h6 class="mb-0 mt-2">Sertifikat</h6>
                        </a></div>
                    <div class="col-6"><a href="#" class="quick-action text-center">
                            <div class="quick-action-icon"><i class="bi bi-person"></i></div>
                            <h6 class="mb-0 mt-2">Profil Saya</h6>
                        </a></div>
                    <div class="col-6"><a href="{{ route('laporan.public') }}" class="quick-action text-center">
                            <div class="quick-action-icon"><i class="bi bi-file-text"></i></div>
                            <h6 class="mb-0 mt-2">Laporan</h6>
                        </a></div>
                </div>
            </div>

            <div class="dashboard-card">
                <h5 class="mb-3">Update Terbaru</h5>
                <div class="update-list">
                    @forelse($recent_donations as $donation)
                        <div class="update-item">
                            <h6 class="mb-1 small">Donasi untuk "{{ Str::limit($donation->program->title, 20) }}"</h6>
                            <p class="small text-muted mb-1">Anda telah berdonasi sebesar Rp
                                {{ number_format($donation->amount, 0, ',', '.') }}</p>
                            <small class="text-muted"><i
                                    class="bi bi-clock me-1"></i>{{ $donation->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <p class="text-muted small">Belum ada update terbaru.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mengambil data yang sudah di-format dari controller
                const donationLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                    'Des'
                ];
                const donationData = @json(array_values($donationChartData));

                const distributionLabels = @json($distributionChartData['labels']);
                const distributionData = @json($distributionChartData['data']);

                // 1. Chart Aktivitas Donasi (Bar Chart)
                const donationCtx = document.getElementById("donationChart").getContext("2d");
                if (donationCtx) {
                    new Chart(donationCtx, {
                        type: "bar",
                        data: {
                            labels: donationLabels,
                            datasets: [{
                                label: "Jumlah Donasi (Rp)",
                                data: donationData,
                                backgroundColor: "rgba(25, 135, 84, 0.6)",
                                borderColor: "#198754",
                                borderWidth: 2,
                                borderRadius: 4,
                            }],
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return "Rp " + context.parsed.y.toString().replace(
                                                /\B(?=(\d{3})+(?!\d))/g, ".");
                                        },
                                    },
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            if (value >= 1000000) {
                                                return "Rp " + (value / 1000000) + "Jt";
                                            }
                                            return "Rp " + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                                ".");
                                        },
                                    },
                                },
                            },
                        },
                    });
                }

                // 2. Chart Distribusi Donasi (Doughnut Chart)
                const distributionCtx = document.getElementById("distributionChart").getContext("2d");
                if (distributionCtx && distributionData.length > 0) {
                    new Chart(distributionCtx, {
                        type: "doughnut",
                        data: {
                            labels: distributionLabels.map(label => label.charAt(0).toUpperCase() + label.slice(
                                1)), // Membuat huruf pertama kapital
                            datasets: [{
                                data: distributionData,
                                backgroundColor: ["#198754", "#20c997", "#ffc107", "#0dcaf0",
                                    "#6f42c1"],
                                borderWidth: 3,
                                borderColor: "#fff",
                            }],
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: "bottom",
                                    labels: {
                                        padding: 20,
                                        usePointStyle: true
                                    },
                                },
                            },
                            cutout: "65%",
                        }
                    });
                } else if (distributionCtx) {
                    // Tampilkan pesan jika tidak ada data donasi
                    distributionCtx.font = "16px Arial";
                    distributionCtx.fillStyle = "#6c757d";
                    distributionCtx.textAlign = "center";
                    distributionCtx.fillText("Belum ada data donasi.", distributionCtx.canvas.width / 2, distributionCtx
                        .canvas.height / 2);
                }
            });
        </script>
    @endpush
</x-layouts.dashboard>
