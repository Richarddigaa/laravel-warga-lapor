<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Donasi Himsi</title>
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
            max-width: 500px;
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
    <section
        class="hero col-lg-6 d-none d-lg-flex align-items-center justify-content-center text-white">
        <div class="text-center px-4">
            <h1 class="fw-bold mb-2">Jadi Bagian dari Perubahan</h1>
            <p class="mb-0" style="max-width: 600px; margin-inline: auto">
                Buat akun untuk mulai melapor & dapatkan poin
            </p>
        </div>
    </section>

    <section
        class="col-12 col-lg-6 d-flex align-items-center justify-content-center py-5 position-relative">
        <a
            href="/"
            class="btn btn-primary rounded-pill position-absolute top-0 end-0 mt-3 me-3">
            <i class="bi bi-house-door"></i> Home
        </a>

        <div class="card form-card bg-white w-100 mx-3">
            <div class="card-body p-4 p-md-5">
                <h2 class="fs-3 fw-semibold text-secondary text-center">Register</h2>
                <p class="text-center text-muted mb-4">
                    Buat akun untuk mulai melapor & dapatkan poin
                </p>

                <form method="POST" action="{{route('register')}}" class="mt-3">
                    @csrf

                    <div class="mb-3">
                        <label for="nik" class="form-label text-secondary">Nomor Induk Kependudukan (NIK)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                            <input
                                type="text"
                                id="nik"
                                name="nik"
                                class="form-control @error('nik') is-invalid @enderror"
                                placeholder="16 digit NIK Anda"
                                value="{{ old('nik') }}"
                                required
                                autofocus
                                pattern="\d{16}"
                                title="NIK harus terdiri dari 16 digit angka." />
                        </div>
                        <div class="form-text">Masukkan 16 digit NIK sesuai KTP.</div>
                        @error('nik') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label text-secondary">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nama sesuai KTP"
                                value="{{ old('name') }}"
                                required />
                        </div>
                        @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

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
                                required />
                        </div>
                        @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label text-secondary">Nomor HP</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="0812xxxxxxx"
                                value="{{ old('phone') }}"
                                pattern="\d{10,13}" />
                        </div>
                        <div class="form-text">Masukkan hanya angka, 10 - 13 digit.</div>
                        @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
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
                                placeholder="Minimal 8 karakter"
                                minlength="8"
                                required />
                            <button
                                class="btn btn-outline-secondary toggle-password"
                                type="button"
                                data-target="#password"
                                aria-label="Show/Hide password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="form-text">
                            Gunakan kombinasi huruf, angka, dan simbol.
                        </div>
                        @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label
                            for="password_confirmation"
                            class="form-label text-secondary">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Ulangi password"
                                minlength="8"
                                required />
                            <button
                                class="btn btn-outline-secondary toggle-password"
                                type="button"
                                data-target="#password_confirmation"
                                aria-label="Show/Hide password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password_confirmation') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <button class="btn btn-primary w-100 fw-semibold py-2 mt-1">Buat Akun</button>
                </form>

                <p class="text-center mt-4 text-muted">
                    Sudah punya akun?
                    <a href="{{route('login')}}" class="text-decoration-none fw-semibold">Kembali ke Login</a>
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

        // Optional: cek konfirmasi password (front-end)
        const pass = document.getElementById("password");
        const pass2 = document.getElementById("password_confirmation");
        if (pass && pass2) {
            const validate = () =>
                pass2.setCustomValidity(
                    pass.value === pass2.value ? "" : "Password tidak sama"
                );
            pass.addEventListener("input", validate);
            pass2.addEventListener("input", validate);
        }
    </script>
</body>

</html>