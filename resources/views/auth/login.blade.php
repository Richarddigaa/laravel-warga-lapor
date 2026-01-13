<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Donasi Himsi</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
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
            --card-radius: 1.25rem;
        }

        body {
            background: #f8fafc;
        }

        .form-card {
            max-width: 420px;
            border: 0;
            border-radius: var(--card-radius);
            box-shadow: 0 12px 40px rgba(2, 8, 23, 0.12);
        }

        .hero {
            position: relative;
            min-height: 100vh;
            background: linear-gradient(120deg,
                    rgba(79, 70, 229, 0.7),
                    rgba(14, 165, 233, 0.7));
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: url("assets/logo/icon-warga-lapor.png") center/40% no-repeat;
            opacity: 0.15;
        }

        .input-group-text {
            background: #f1f5f9;
            border-color: #e5e7eb;
        }
    </style>
</head>

<body class="d-flex flex-column flex-lg-row min-vh-100">
    <!-- LEFT: Hero (hidden on small) -->
    <section
        class="hero col-lg-6 d-none d-lg-flex align-items-center justify-content-center text-white">
        <div class="text-center px-4">
            <h1 class="fw-bold mb-2">Mari Perbaiki Kota, Mulai Sekarang</h1>
            <p class="mb-0" style="max-width: 560px; margin-inline: auto">
                Masuk untuk mulai berkontribusi
            </p>
        </div>
    </section>

    <!-- RIGHT: Form -->
    <section
        class="col-12 col-lg-6 d-flex align-items-center justify-content-center py-5 position-relative">
        <a
            href="/"
            class="btn btn-primary rounded-pill position-absolute top-0 end-0 mt-3 me-3">
            <i class="bi bi-house-door"></i> Home
        </a>

        <div class="card form-card bg-white w-100 mx-3">
            <div class="card-body p-4 p-md-5">
                <h2 class="fs-3 fw-semibold text-secondary text-center">Login</h2>
                <p class="text-center text-muted mb-4">
                    Selamat datang kembali di Warga Lapor
                </p>

                <!-- GANTI action ke endpoint milikmu -->
                <form method="POST" action="{{route('login')}}" class="mt-3">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label text-secondary">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="email@example.com"
                                value="{{ old('email') }}"
                                autofocus required />
                        </div>
                        @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-secondary">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="••••••••"
                                required />
                            <button
                                class="btn btn-outline-secondary toggle-password"
                                type="button"
                                data-target="#password"
                                aria-label="Show/Hide password">
                                <i class="bi bi-eye"></i>
                            </button>
                            @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted" for="remember">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">Lupa Kata Sandi?</a>
                        @endif
                    </div>

                    <button class="btn btn-primary w-100 fw-semibold py-2">Masuk</button>
                </form>

                <p class="text-center mt-4 text-muted">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password
        document.querySelectorAll(".toggle-password").forEach((btn) => {
            btn.addEventListener("click", () => {
                const input = document.querySelector(btn.dataset.target);
                const icon = btn.querySelector("i");
                if (!input) return;
                input.type = input.type === "password" ? "text" : "password";
                icon.classList.toggle("bi-eye");
                icon.classList.toggle("bi-eye-slash");
            });
        });
    </script>
</body>

</html>