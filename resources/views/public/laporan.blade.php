<x-layouts.app>
    <x-slot:title>Laporan Keuangan - Dana Sosial UNAND</x-slot:title>

    @push('styles')
        <style>
            .reports-hero {
                background: linear-gradient(135deg,
                        rgba(25, 135, 84, 0.9) 0%,
                        rgba(32, 201, 151, 0.9) 100%),
                    url("https://via.placeholder.com/1920x600/198754/ffffff?text=Laporan+Keuangan") center/cover;
                color: white;
                padding: 100px 0;
            }

            .stats-card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                text-align: center;
                transition: transform 0.3s ease;
            }

            .stats-card:hover {
                transform: translateY(-5px);
            }

            .stats-icon {
                width: 60px;
                height: 60px;
                background: rgba(25, 135, 84, 0.1);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                color: #198754;
                font-size: 1.5rem;
            }

            .chart-container {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                margin-bottom: 2rem;
            }

            .report-period {
                background: white;
                border-radius: 1rem;
                padding: 1.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            .download-btn {
                border: 2px solid #198754;
                color: #198754;
                padding: 0.5rem 1.5rem;
                border-radius: 2rem;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            .download-btn:hover {
                background: #198754;
                color: white;
            }

            .table-responsive {
                border-radius: 1rem;
                overflow: hidden;
            }

            .table th {
                background: #198754;
                color: white;
                border: none;
            }

            .progress-bar {
                border-radius: 1rem;
            }

            .audit-badge {
                background: #20c997;
                color: white;
                padding: 0.25rem 0.75rem;
                border-radius: 2rem;
                font-size: 0.875rem;
            }
        </style>
    @endpush

    <!-- Reports Hero Section -->
    <section class="reports-hero" style="padding-top: 150px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Laporan Keuangan</h1>
                    <p class="lead mb-4">
                        Transparansi dan akuntabilitas dalam pengelolaan dana donasi untuk
                        membangun kepercayaan bersama.
                    </p>
                    <div class="hero-stats">
                        <div class="row justify-content-center">
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">100%</h3>
                                    <p class="stat-label text-white-50">Transparan</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">Rp 8.5M+</h3>
                                    <p class="stat-label text-white-50">Terkumpul</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-item">
                                    <h3 class="stat-number text-white">Rp 7.2M+</h3>
                                    <p class="stat-label text-white-50">Tersalurkan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats Section -->
    <section class="quick-stats-section py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <h3 class="text-success">Rp 8.5 M</h3>
                        <p class="text-muted mb-0">Total Donasi Terkumpul</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3 class="text-success">Rp 7.2 M</h3>
                        <p class="text-muted mb-0">Total Dana Tersalurkan</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="text-success">1,245</h3>
                        <p class="text-muted mb-0">Total Donatur</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <h3 class="text-success">25</h3>
                        <p class="text-muted mb-0">Program Terealisasi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="reports-content-section py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="report-period">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-0">Laporan Keuangan 2024</h4>
                                <p class="text-muted mb-0">Periode Januari - Desember 2024</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="d-flex gap-2 justify-content-md-end flex-wrap">
                                    <a href="#" class="download-btn">
                                        <i class="bi bi-file-pdf"></i> Download PDF
                                    </a>
                                    <a href="#" class="download-btn">
                                        <i class="bi bi-file-excel"></i> Download Excel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-6">
                    <div class="chart-container">
                        <h5 class="mb-4">Distribusi Donasi per Program</h5>
                        <canvas id="programDistributionChart" height="250"></canvas>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="chart-container">
                        <h5 class="mb-4">Trend Donasi Bulanan 2024</h5>
                        <canvas id="monthlyTrendChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Detailed Reports -->
            <div class="row">
                <div class="col-12">
                    <div class="chart-container">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Rincian Penerimaan dan Penyaluran Dana</h5>
                            <span class="audit-badge"><i class="bi bi-shield-check me-1"></i> Telah Diaudit</span>
                        </div>

                        <!-- Income Table -->
                        <div class="mb-5">
                            <h6 class="text-success mb-3">Penerimaan Donasi</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Program</th>
                                            <th>Target</th>
                                            <th>Terkumpul</th>
                                            <th>Progress</th>
                                            <th>Donatur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Beasiswa Mahasiswa Berprestasi</td>
                                            <td>Rp 1.000.000.000</td>
                                            <td>Rp 750.000.000</td>
                                            <td>
                                                <div class="progress" style="height: 8px">
                                                    <div class="progress-bar bg-success" style="width: 75%"></div>
                                                </div>
                                                <small>75%</small>
                                            </td>
                                            <td>320</td>
                                        </tr>
                                        <tr>
                                            <td>Zakat Fitrah 1445 H</td>
                                            <td>Rp 500.000.000</td>
                                            <td>Rp 450.000.000</td>
                                            <td>
                                                <div class="progress" style="height: 8px">
                                                    <div class="progress-bar bg-info" style="width: 90%"></div>
                                                </div>
                                                <small>90%</small>
                                            </td>
                                            <td>285</td>
                                        </tr>
                                        <tr>
                                            <td>Bantuan Bencana Alam</td>
                                            <td>Rp 500.000.000</td>
                                            <td>Rp 480.000.000</td>
                                            <td>
                                                <div class="progress" style="height: 8px">
                                                    <div class="progress-bar bg-warning" style="width: 96%"></div>
                                                </div>
                                                <small>96%</small>
                                            </td>
                                            <td>412</td>
                                        </tr>
                                        <tr>
                                            <td>Dana Abadi UNAND</td>
                                            <td>Rp 5.000.000.000</td>
                                            <td>Rp 1.500.000.000</td>
                                            <td>
                                                <div class="progress" style="height: 8px">
                                                    <div class="progress-bar bg-primary" style="width: 30%"></div>
                                                </div>
                                                <small>30%</small>
                                            </td>
                                            <td>156</td>
                                        </tr>
                                        <tr>
                                            <td>Beasiswa Anak Buruh</td>
                                            <td>Rp 500.000.000</td>
                                            <td>Rp 300.000.000</td>
                                            <td>
                                                <div class="progress" style="height: 8px">
                                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                                </div>
                                                <small>60%</small>
                                            </td>
                                            <td>198</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-success">
                                        <tr>
                                            <th>Total</th>
                                            <th>Rp 7.500.000.000</th>
                                            <th>Rp 3.480.000.000</th>
                                            <th>-</th>
                                            <th>1,371</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- Expenditure Table -->
                        <div class="mb-4">
                            <h6 class="text-success mb-3">Penyaluran Dana</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Program</th>
                                            <th>Dana Tersalur</th>
                                            <th>Penerima Manfaat</th>
                                            <th>Tanggal Penyaluran</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Beasiswa Mahasiswa Berprestasi</td>
                                            <td>Rp 700.000.000</td>
                                            <td>150 mahasiswa</td>
                                            <td>15 Des 2024</td>
                                            <td><span class="badge bg-success">Selesai</span></td>
                                        </tr>
                                        <tr>
                                            <td>Zakat Fitrah 1445 H</td>
                                            <td>Rp 420.000.000</td>
                                            <td>500 keluarga</td>
                                            <td>10 Apr 2024</td>
                                            <td><span class="badge bg-success">Selesai</span></td>
                                        </tr>
                                        <tr>
                                            <td>Bantuan Bencana Alam</td>
                                            <td>Rp 450.000.000</td>
                                            <td>1,200 korban</td>
                                            <td>5 Mar 2024</td>
                                            <td><span class="badge bg-success">Selesai</span></td>
                                        </tr>
                                        <tr>
                                            <td>Beasiswa Anak Buruh</td>
                                            <td>Rp 280.000.000</td>
                                            <td>75 mahasiswa</td>
                                            <td>20 Nov 2024</td>
                                            <td><span class="badge bg-warning">Berjalan</span></td>
                                        </tr>
                                        <tr>
                                            <td>Renovasi Perpustakaan</td>
                                            <td>Rp 350.000.000</td>
                                            <td>Fakultas Teknik</td>
                                            <td>1 Okt 2024</td>
                                            <td><span class="badge bg-success">Selesai</span></td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-success">
                                        <tr>
                                            <th>Total</th>
                                            <th>Rp 2.200.000.000</th>
                                            <th>1,925 penerima</th>
                                            <th>-</th>
                                            <th>-</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audit Information -->
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="chart-container">
                        <h5 class="text-center mb-4">
                            <i class="bi bi-shield-check text-success me-2"></i>Informasi
                            Audit
                        </h5>
                        <div class="row text-center">
                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-3">
                                    <i class="bi bi-building text-success display-6 mb-3"></i>
                                    <h6>KAP Andalas Mandiri</h6>
                                    <p class="text-muted mb-0">Auditor Eksternal</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-3">
                                    <i class="bi bi-calendar-check text-success display-6 mb-3"></i>
                                    <h6>15 Januari 2025</h6>
                                    <p class="text-muted mb-0">Audit Selanjutnya</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="border rounded p-3">
                                    <i class="bi bi-file-text text-success display-6 mb-3"></i>
                                    <h6>WTP</h6>
                                    <p class="text-muted mb-0">Opini Audit</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <p class="text-muted">
                                Laporan keuangan Dana Sosial UNAND diaudit secara berkala oleh
                                auditor independen untuk memastikan akuntabilitas dan
                                transparansi.
                            </p>
                            <a href="#" class="btn btn-outline-success">Download Laporan Audit</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Previous Reports -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="chart-container">
                        <h5 class="mb-4">Laporan Periode Sebelumnya</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Total Penerimaan</th>
                                        <th>Total Penyaluran</th>
                                        <th>Status Audit</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2023 (Jan - Des)</td>
                                        <td>Rp 6.200.000.000</td>
                                        <td>Rp 5.800.000.000</td>
                                        <td>
                                            <span class="badge bg-success">Telah Diaudit</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-outline-success btn-sm"><i
                                                    class="bi bi-download me-1"></i> PDF</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2022 (Jan - Des)</td>
                                        <td>Rp 5.500.000.000</td>
                                        <td>Rp 5.100.000.000</td>
                                        <td>
                                            <span class="badge bg-success">Telah Diaudit</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-outline-success btn-sm"><i
                                                    class="bi bi-download me-1"></i> PDF</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2021 (Jan - Des)</td>
                                        <td>Rp 4.800.000.000</td>
                                        <td>Rp 4.500.000.000</td>
                                        <td>
                                            <span class="badge bg-success">Telah Diaudit</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-outline-success btn-sm"><i
                                                    class="bi bi-download me-1"></i> PDF</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        {{-- Skrip untuk Chart.js dan fungsionalitas lain --}}
        <script>
            // Initialize AOS
            AOS.init();

            // TODO: Data untuk chart ini akan dibuat dinamis dari database
            // Program Distribution Chart
            const programCtx = document.getElementById("programDistributionChart").getContext("2d");
            const programChart = new Chart(programCtx, {
                type: "doughnut",
                data: {
                    labels: ["Beasiswa", "Zakat", "Bantuan Bencana", "Dana Abadi", "Fasilitas"],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: ["#198754", "#20c997", "#ffc107", "#0dcaf0", "#6f42c1"],
                        borderWidth: 2,
                        borderColor: "#fff",
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "bottom"
                        }
                    }
                }
            });

            // Monthly Trend Chart
            const trendCtx = document.getElementById("monthlyTrendChart").getContext("2d");
            const trendChart = new Chart(trendCtx, {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                    datasets: [{
                        label: "Penerimaan (Juta Rupiah)",
                        data: [450, 520, 480, 620, 580, 710, 680, 750, 820, 780, 850, 920],
                        borderColor: "#198754",
                        backgroundColor: "rgba(25, 135, 84, 0.1)",
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return "Rp " + value + "Jt";
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
</x-layouts.app>
