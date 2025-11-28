<div class="sidebar">
    <div class="dashboard-card">
        <h6 class="fw-bold mb-3 text-success">Menu Dashboard</h6>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i>Overview
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('dashboard.donations') ? 'active' : '' }}"
                    href="{{ route('dashboard.donations') }}">
                    <i class="bi bi-heart"></i>Donasi Saya
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('dashboard.transactions') ? 'active' : '' }}"
                    href="{{ route('dashboard.transactions') }}">
                    <i class="bi bi-credit-card"></i>Riwayat Transaksi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('dashboard.certificates') ? 'active' : '' }}"
                    href="{{ route('dashboard.certificates') }}">
                    <i class="bi bi-award"></i>Sertifikat Donasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('dashboard.profile') ? 'active' : '' }}"
                    href="{{ route('dashboard.profile') }}">
                    <i class="bi bi-person"></i>Profil Saya
                </a>
            </li>
        </ul>
    </div>
</div>
