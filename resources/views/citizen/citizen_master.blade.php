<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

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

    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        body {
            background: #f5f7fb;
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

        .container-7xl {
            max-width: 1280px;
        }
    </style>

    @stack('style')


</head>

<body>
    <!-- NAVBAR -->
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
                    alt="Logo WargaLapor" />
            </a>

            <!-- Toggler -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navMain"
                aria-controls="navMain"
                aria-expanded="false"
                aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('citizen.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('citizen.reports.index')}}">Daftar Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('citizen.reports.create')}}">Buat Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('citizen.rewards.index')}}">Tukarkan Poin</a>
                    </li>

                    <!-- User Dropdown -->
                    <li class="nav-item dropdown ms-lg-2">
                        <a
                            class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                            href="#"
                            id="userMenu"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <!-- Jika user ada avatar -->
                            @if(Auth::user()->avatar)
                            <img
                                src="{{Storage::url(Auth::user()->avatar)}}"
                                alt="{{Auth::user()->name}}"
                                class="rounded-circle avatar-32"
                                loading="lazy" />

                            <!-- Jika user tidak ada avatar -->
                            @else
                            <img
                                src="{{asset('assets/img/user.png')}}"
                                alt="{{Auth::user()->name}}"
                                class="rounded-circle avatar-32"
                                loading="lazy" />
                            @endif

                            <span class="d-none d-md-inline">{{Auth::user()->name}}</span>
                        </a>

                        <ul
                            class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-2"
                            aria-labelledby="userMenu"
                            style="min-width: 280px">
                            <!-- Header user -->
                            <li class="px-3 pt-2 pb-2">
                                <div class="d-flex align-items-center">

                                    <!-- Jika user ada avatar -->
                                    @if(Auth::user()->avatar)
                                    <img
                                        src="{{Storage::url(Auth::user()->avatar)}}"
                                        alt="{{Auth::user()->name}}"
                                        class="rounded-circle me-3 avatar-40"
                                        loading="lazy" />

                                    <!-- Jika user tidak ada avatar -->
                                    @else
                                    <img
                                        src="{{asset('assets/img/user.png')}}"
                                        alt="{{Auth::user()->name}}"
                                        class="rounded-circle me-3 avatar-40"
                                        loading="lazy" />
                                    @endif

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
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN -->
    @yield('content')

    <!-- FOOTER -->
    <footer class="bg-dark text-white">
        <div class="container py-5">
            <div class="row g-4">
                <!-- Brand -->
                <div class="col-12 col-md-6">
                    <a
                        class="d-flex align-items-center py-2"
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
                                href="{{route('citizen.dashboard')}}"
                                class="text-white-50 text-decoration-none">Dashboard</a>
                        </li>
                        <li class="mb-2">
                            <a
                                href="{{route('citizen.reports.index')}}"
                                class="text-white-50 text-decoration-none">Daftar Laporan</a>
                        </li>
                        <li class="mb-2">
                            <a
                                href="{{route('citizen.reports.create')}}"
                                class="text-white-50 text-decoration-none">Buat Laporan</a>
                        </li>
                        <li class="mb-2">
                            <a
                                href="{{route('citizen.rewards.index')}}"
                                class="text-white-50 text-decoration-none">Tukarkan Poin</a>
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

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(title, type) {
            Swal.fire({
                title: title,
                icon: type, // 'success', 'error', 'warning', 'info'
                confirmButtonText: 'OK'
            });
        }
    </script>

    @stack('scripts')

    @if(session('alert'))
    <script>
        showAlert(
            "{{ session('alert.title') }}",
            "{{ session('alert.type') }}"
        );
    </script>
    @endif
</body>

</html>