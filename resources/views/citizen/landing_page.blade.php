<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Beranda | WargaLapor</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet" />

    <link
        rel="icon"
        href="{{asset('assets/logo/icon-warga-lapor.png')}}"
        type="image/x-icon" />

    <style>
        :root {
            --bs-primary: #0d6efd;
            --nav-h: 64px;
        }

        [id] {
            scroll-margin-top: var(--nav-h);
        }

        body {
            background-color: #f5f7fb;
        }

        html {
            scroll-behavior: smooth;
        }

        .avatar-32 {
            width: 32px;
            height: 32px;
            object-fit: cover;
        }

        .avatar-40 {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .hero {
            position: relative;
            overflow: hidden;
        }

        .hero-illustration {
            max-height: 320px;
            width: auto;
        }

        @media (min-width: 1200px) {
            .hero-illustration {
                max-height: 420px;
            }
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
        }

        .shadow-soft {
            box-shadow: 0 10px 26px rgba(2, 8, 23, 0.08);
        }

        /* Kartu laporan */
        .card-hover:hover {
            box-shadow: 0 12px 24px rgba(2, 8, 23, 0.08);
            transition: 0.2s ease;
        }

        .status-badge {
            font-weight: 600;
        }

        /* potong teks jadi 2 baris */
        .text-truncate-2 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            overflow: hidden;
        }

        /* FAQ accordion */
        #faq .accordion-button {
            background: #fff;
            color: #212529;
        }

        #faq .accordion-button:not(.collapsed) {
            background: var(--bs-primary);
            color: #fff;
            box-shadow: none;
        }

        #faq .accordion-button::after {
            filter: none;
        }

        #faq .accordion-button:not(.collapsed)::after {
            filter: brightness(0) invert(1);
        }

        #faq .accordion-body {
            background: #fff;
        }

        /* CTA jadi kartu gradasi rounded */
        .cta-gradient {
            background: linear-gradient(135deg,
                    #4f86ff 0%,
                    #5aa3ff 45%,
                    #6ec1ff 100%);
            border-radius: 28px;
            padding: 3rem 1.25rem;
            box-shadow: 0 18px 45px rgba(2, 8, 23, 0.15);
        }

        @media (min-width: 992px) {
            .cta-gradient {
                padding: 4rem 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav
        class="navbar navbar-expand-lg bg-white border-bottom sticky-top shadow-sm">
        <div class="container">
            <!-- Brand -->
            <a
                class="d-flex align-items-center py-2"
                href="{{route('citizen.index')}}">
                <img
                    src="{{asset('assets/logo/logo-warga-lapor-2.png')}}"
                    style="height: 60px; width: auto;"
                    alt="Icon WargaLapor" />
            </a>

            <!-- Toggler -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarPrimary"
                aria-controls="navbarPrimary"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarPrimary">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('citizen.index')}}">Beranda</a>
                    </li>
                    <!-- HAPUS: item Fitur -->
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{route('citizen.index')}}#how-it-works"
                            data-hash="#how-it-works">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{route('citizen.index')}}#latest-reports"
                            data-hash="#latest-reports">Daftar Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('citizen.index')}}#faq" data-hash="#faq">FAQ</a>
                    </li>

                    <!-- User Dropdown -->
                    @auth
                    <li class="nav-item dropdown ms-lg-2">
                        <a
                            class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                            href="#"
                            id="userMenu"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img
                                src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('assets/img/user.png') }}"
                                alt="{{Auth::user()->name}}"
                                class="rounded-circle avatar-32" />
                            <span class="d-none d-md-inline">{{Auth::user()->name}}</span>
                        </a>

                        <ul
                            class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-2"
                            aria-labelledby="userMenu"
                            style="min-width: 280px">
                            <!-- Header user -->
                            <li class="px-3 pt-2 pb-2">
                                <div class="d-flex align-items-center">
                                    <img
                                        src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('assets/img/user.png') }}"
                                        alt="{{Auth::user()->name}}"
                                        class="rounded-circle me-3 avatar-40" />
                                    <div class="min-w-0">
                                        <div class="fw-semibold text-truncate">{{Auth::user()->name}}</div>
                                        <div class="small text-secondary text-truncate">
                                            {{Auth::user()->email}}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 d-flex gap-2">
                                    <span
                                        class="badge rounded-pill bg-primary-subtle text-primary-emphasis">Poin: {{Auth::user()->getCurrentPoints()}}</span>
                                </div>
                            </li>

                            <!-- Aksi -->
                            <li>
                                @role('super_admin')
                                <a
                                    class="dropdown-item d-flex align-items-center gap-2"
                                    href="{{route('admin.dashboard')}}">
                                    <i class="bi bi-house-door"></i> Dashboard
                                </a>
                                @else
                                <a
                                    class="dropdown-item d-flex align-items-center gap-2"
                                    href="{{route('citizen.dashboard')}}">
                                    <i class="bi bi-house-door"></i> Dashboard
                                </a>
                                @endrole
                            </li>

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center gap-2"
                                    href="{{route('citizen.profile.index')}}">
                                    <i class="bi bi-person"></i> Ubah Profil
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logoutForm">@csrf</form>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Keluar
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>

                @guest
                <!-- Actions -->
                <div class="d-flex gap-2 ms-lg-3 mt-3 mt-lg-0">
                    <a class="btn btn-outline-primary btn-sm" href="{{route('login')}}">Masuk</a>
                    <a class="btn btn-primary btn-sm" href="{{route('register')}}">Daftar</a>
                </div>
                @endguest

            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section id="home" class="hero py-4 py-md-4 bg-white">
        <div class="container">
            <div class="row align-items-center g-3">
                <!-- Teks -->
                <div class="col-lg-6 col-xl-7 text-center text-xl-start">
                    <h1 class="h2 h1-md fw-bold mb-2 mt-0 text-dark">
                        Laporkan Masalah
                        <span class="text-primary">Infrastruktur & Kebersihan</span>
                        dengan Mudah
                    </h1>
                    <p class="lead mb-3 text-muted" style="max-width: 720px">
                        Platform digital yang menghubungkan warga dengan pemerintah daerah
                        untuk melaporkan kerusakan jalan, jembatan, dan masalah
                        kebersihan. Bersama membangun lingkungan yang lebih baik.
                    </p>

                    <div
                        class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-xl-start">
                        <a class="btn btn-primary btn-lg px-4" href="{{ route('citizen.reports.create') }}">Mulai Melaporkan</a>
                        <a
                            class="btn btn-outline-primary btn-lg px-4"
                            href="#how-it-works"
                            aria-label="Pelajari cara kerja WargaLapor">Pelajari Cara Kerja</a>
                    </div>

                    <div
                        class="d-flex flex-wrap align-items-center gap-4 mt-3 justify-content-center justify-content-xl-start text-muted">
                        <span class="d-inline-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-success"></i>Terpercaya
                            Pemerintah</span>
                        <span class="d-inline-flex align-items-center gap-2"><i class="bi bi-shield-fill-check text-success"></i>Data Aman &
                            Privasi Terjaga</span>
                    </div>
                </div>

                <!-- Gambar -->
                <div
                    class="col-lg-6 col-xl-5 d-none d-lg-flex flex-column align-items-center">
                    <img
                        src="assets/img/hero-warga-lapor-2.png"
                        alt="Illustration by Storyset (storyset.com)"
                        class="img-fluid hero-illustration"
                        loading="lazy" />
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-3 py-md-4">
        <div class="container">
            <div class="card shadow-lg" style="margin-top: -20px; z-index: 10">
                <div class="card-body p-4">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="stat-value fw-bold text-primary">23,567</div>
                            <div class="text-secondary">Jumlah Laporan Sekarang</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="stat-value fw-bold text-primary">18,567</div>
                            <div class="text-secondary">Laporan Selesai</div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-value fw-bold text-primary">4,345</div>
                            <div class="text-secondary">Warga Aktif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-4 mb-md-5">
                <h2 class="h1 fw-semibold mb-2">Cara Kerja</h2>
                <p class="text-secondary mb-0">
                    Empat langkah mudah untuk melaporkan masalah di lingkungan Anda
                </p>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="text-center h-100 p-4 bg-white rounded-4 shadow-soft">
                        <div
                            class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 64px; height: 64px; font-weight: 700">
                            1
                        </div>
                        <h3 class="h5">Daftar/Login</h3>
                        <p class="text-secondary mb-0">
                            Buat akun atau masuk ke platform WargaLapor.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="text-center h-100 p-4 bg-white rounded-4 shadow-soft">
                        <div
                            class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 64px; height: 64px; font-weight: 700">
                            2
                        </div>
                        <h3 class="h5">Buat Laporan</h3>
                        <p class="text-secondary mb-0">
                            Isi form laporan dengan foto dan lokasi akurat.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="text-center h-100 p-4 bg-white rounded-4 shadow-soft">
                        <div
                            class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 64px; height: 64px; font-weight: 700">
                            3
                        </div>
                        <h3 class="h5">Verifikasi</h3>
                        <p class="text-secondary mb-0">
                            Tim akan memeriksa dan memvalidasi laporan Anda.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="text-center h-100 p-4 bg-white rounded-4 shadow-soft">
                        <div
                            class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 64px; height: 64px; font-weight: 700">
                            4
                        </div>
                        <h3 class="h5">Selesai & Poin</h3>
                        <p class="text-secondary mb-0">
                            Dapatkan poin saat valid dan pantau progres.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar -->
    <section id="latest-reports" class="py-5">
        <div class="container">
            <div class="text-center mb-4 mb-md-5">
                <h2 class="h1 fw-semibold mb-2">Daftar Laporan</h2>
                <p class="text-secondary mb-0">
                    Pantau semua laporan masalah infrastruktur dan kebersihan dari warga
                </p>
            </div>

            <div class="row g-4 justify-content-center">

                @forelse ($reports as $report)

                @php
                $statusClass = match ($report->latest_status) {
                'pending' => 'bg-secondary-subtle text-secondary-emphasis',
                'verified' => 'bg-info-subtle text-info-emphasis',
                'in_progress' => 'bg-warning-subtle text-warning-emphasis',
                'resolved' => 'bg-success-subtle text-success-emphasis',
                'rejected' => 'bg-danger-subtle text-danger-emphasis',
                default => 'bg-light text-muted',
                };
                @endphp

                <!-- Card 1 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 card-hover">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h3 class="h6 mb-0">{{ $report->title }}</h3>
                                    <small class="text-secondary">{{ $report->code }}</small>
                                </div>
                                <span class="badge rounded-pill {{ $statusClass }} status-badge">
                                    {{ Str::title(str_replace('_', ' ', $report->latest_status ?? 'N/A')) }}
                                </span>
                            </div>

                            <p class="text-secondary text-truncate-2 mb-3">{{ $report->description }}</p>

                            <div class="d-flex flex-wrap align-items-center gap-3 text-secondary small mb-2">
                                <span class="d-flex align-items-center">
                                    <i class="bi bi-tag me-1"></i> {{$report->category->name}}
                                </span>
                                <span class="d-flex align-items-center">
                                    <i class="bi bi-calendar-event me-1"></i> {{ $report->created_at->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            <div class="d-flex align-items-center text-secondary small mb-3">
                                <i class="bi bi-geo-alt me-2 flex-shrink-0"></i>
                                <p class="mb-0 text-truncate-2">
                                    {{ $report->location }}
                                </p>
                            </div>

                            <a href="{{ route('citizen.reports.show', $report) }}" class="btn btn-outline-primary w-100 mt-auto">
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </a>

                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-light border text-center mb-0">
                        Tidak ada laporan.
                    </div>
                </div>
                @endforelse

            </div>

            <!-- CTA kecil -->
            <div class="text-center mt-4">
                <a href="{{route('citizen.reports.index')}}" class="btn btn-outline-primary px-4">Lihat Semua</a>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-4 mb-lg-5">
                <h2 class="h1 fw-bold mb-2">Pertanyaan yang Sering Diajukan</h2>
                <p class="lead text-secondary">
                    Temukan jawaban untuk pertanyaan umum tentang WargaLapor
                </p>
            </div>

            <div class="accordion" id="faqAccordion">
                <!-- 1 -->
                <div class="card card-raise mb-3">
                    <h3 class="accordion-header" id="fq1">
                        <button
                            class="accordion-button px-4 collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#fc1"
                            aria-expanded="false"
                            aria-controls="fc1">
                            <span class="fw-semibold">Bagaimana cara melaporkan masalah infrastruktur?</span>
                        </button>
                    </h3>
                    <div
                        id="fc1"
                        class="accordion-collapse collapse"
                        aria-labelledby="fq1"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body px-4 pt-0 pb-4 text-secondary">
                            Cukup daftar akun, ambil foto masalah infrastruktur, tambahkan
                            deskripsi minimal 20 karakter, tentukan lokasi dengan GPS, dan
                            kirim laporan. Anda akan mendapat nomor tiket unik untuk
                            tracking.
                        </div>
                    </div>
                </div>

                <!-- 2 -->
                <div class="card card-raise mb-3">
                    <h3 class="accordion-header" id="fq2">
                        <button
                            class="accordion-button px-4 collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#fc2"
                            aria-expanded="false"
                            aria-controls="fc2">
                            <span class="fw-semibold">Berapa lama waktu respons pemerintah?</span>
                        </button>
                    </h3>
                    <div
                        id="fc2"
                        class="accordion-collapse collapse"
                        aria-labelledby="fq2"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body px-4 pt-0 pb-4 text-secondary">
                            Verifikasi laporan biasanya dilakukan dalam 1-3 hari kerja.
                            Proses perbaikan tergantung tingkat prioritas dan kompleksitas
                            masalah, rata-rata 1-4 minggu untuk masalah menengah.
                        </div>
                    </div>
                </div>

                <!-- 3 -->
                <div class="card card-raise mb-3">
                    <h3 class="accordion-header" id="fq3">
                        <button
                            class="accordion-button px-4 collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#fc3"
                            aria-expanded="false"
                            aria-controls="fc3">
                            <span class="fw-semibold">Apakah data pribadi saya aman?</span>
                        </button>
                    </h3>
                    <div
                        id="fc3"
                        class="accordion-collapse collapse"
                        aria-labelledby="fq3"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body px-4 pt-0 pb-4 text-secondary">
                            Ya, WargaLapor menggunakan enkripsi tingkat tinggi dan mematuhi
                            standar keamanan pemerintah Indonesia. Data pribadi hanya
                            digunakan untuk keperluan pelaporan dan tidak dibagikan ke pihak
                            ketiga.
                        </div>
                    </div>
                </div>

                <!-- 4 -->
                <div class="card card-raise mb-3">
                    <h3 class="accordion-header" id="fq4">
                        <button
                            class="accordion-button px-4 collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#fc4"
                            aria-expanded="false"
                            aria-controls="fc4">
                            <span class="fw-semibold">Bagaimana sistem poin bekerja?</span>
                        </button>
                    </h3>
                    <div
                        id="fc4"
                        class="accordion-collapse collapse"
                        aria-labelledby="fq4"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body px-4 pt-0 pb-4 text-secondary">
                            Anda mendapat 10-100 poin saat laporan diverifikasi dan 200-400
                            poin tambahan saat masalah selesai diperbaiki. Poin dapat
                            ditukar dengan reward atau digunakan untuk meningkatkan status
                            warga aktif.
                        </div>
                    </div>
                </div>

                <!-- 5 -->
                <div class="card card-raise">
                    <h3 class="accordion-header" id="fq5">
                        <button
                            class="accordion-button px-4 collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#fc5"
                            aria-expanded="false"
                            aria-controls="fc5">
                            <span class="fw-semibold">Apakah ada batasan jumlah laporan per hari?</span>
                        </button>
                    </h3>
                    <div
                        id="fc5"
                        class="accordion-collapse collapse"
                        aria-labelledby="fq5"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body px-4 pt-0 pb-4 text-secondary">
                            Ya, untuk mencegah spam, setiap pengguna dibatasi maksimal 5
                            laporan per hari. Ini memastikan kualitas laporan tetap tinggi
                            dan sistem tidak overload.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-4 py-md-5">
        <div class="container" style="max-width: 1100px">
            <div class="cta-gradient text-center text-white">
                <h2 class="display-6 fw-bold mb-2">
                    Siap Berkontribusi untuk Indonesia?
                </h2>
                <p class="lead mb-4" style="color: rgba(255, 255, 255, 0.85)">
                    Bergabunglah dengan ribuan warga Indonesia yang telah membantu
                    memperbaiki infrastruktur di lingkungan mereka
                </p>
                <div class="d-grid d-sm-flex gap-3 justify-content-center">
                    <a href="{{route('register')}}" class="btn btn-light touch-target px-4">
                        Daftar Gratis Sekarang
                    </a>
                    <a
                        href="{{route('login')}}"
                        class="btn btn-outline-light touch-target px-4">
                        Sudah Punya Akun? Masuk
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white">
        <div class="container py-5">
            <div class="row g-4">
                <!-- Brand -->
                <div class="col-12 col-md-6">
                    <a
                        class="-flex align-items-center py-2"
                        href="{{route('citizen.index')}}">
                        <img
                            src="{{asset('assets/logo/logo-warga-lapor-footer.png')}}"
                            style="height: 60px; width: auto;"
                            alt="Logo WargaLapor" />
                    </a>
                    <p class="text-white-50 mb-4">
                        Platform digital yang menghubungkan warga dengan pemerintah daerah
                        untuk melaporkan kerusakan jalan, jembatan, dan masalah
                        kebersihan. Bersama membangun lingkungan yang lebih baik.
                    </p>
                    <div class="d-flex gap-3">
                        <a
                            href="#"
                            class="text-white-50 d-inline-flex align-items-center"
                            aria-label="Facebook"><i class="bi bi-facebook fs-5"></i></a>
                        <a
                            href="#"
                            class="text-white-50 d-inline-flex align-items-center"
                            aria-label="Twitter"><i class="bi bi-twitter-x fs-5"></i></a>
                        <a
                            href="#"
                            class="text-white-50 d-inline-flex align-items-center"
                            aria-label="Instagram"><i class="bi bi-instagram fs-5"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-6 col-md-3">
                    <h4 class="h6 fw-semibold text-white mb-3">Tautan Cepat</h4>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <a href="{{route('citizen.index')}}" class="text-white-50 text-decoration-none">Beranda</a>
                        </li>
                        <li class="mb-2">
                            <a
                                href="{{route('citizen.index')}}#how-it-works"
                                class="text-white-50 text-decoration-none">Cara Kerja</a>
                        </li>
                        <li class="mb-2">
                            <a
                                href="{{route('citizen.index')}}#latest-reports"
                                class="text-white-50 text-decoration-none">Daftar Laporan</a>
                        </li>
                        <li class="mb-2">
                            <a
                                href="{{route('citizen.index')}}#faq"
                                class="text-white-50 text-decoration-none">FAQ</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-6 col-md-3">
                    <h4 class="h6 fw-semibold text-white mb-3">Kontak</h4>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2 text-white-50">
                            Email:
                            <a
                                href="mailto:info@wargalapor.id"
                                class="link-light text-decoration-none">info@wargalapor.id</a>
                        </li>
                        <li class="mb-2 text-white-50">
                            Tel:
                            <a
                                href="tel:+62211234567"
                                class="link-light text-decoration-none">(021) 123-4567</a>
                        </li>
                        <li class="text-white-50">Alamat: Bekasi, Indonesia</li>
                    </ul>
                </div>
            </div>

            <div class="border-top border-secondary mt-4 pt-4 text-center">
                <p class="text-white-50 mb-0">
                    Copyright &copy; RICHARD DIGA ANDREANSYAH 2025
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>