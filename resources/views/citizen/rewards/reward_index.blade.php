@extends('citizen.citizen_master')

@section('title', 'Poin & Hadiah | WargaLapor')

@push('style')
<style>
    :root {
        --primary: #0d6efd;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --border: #e5e7eb;
        --bg: #f5f7fb;
    }

    .card {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 10px 28px rgba(2, 8, 23, 0.08);
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(13, 110, 253, 0.12);
        color: var(--primary);
    }

    .filter-pill .btn {
        border-radius: 999px;
    }

    .reward-thumb {
        height: 110px;
        background: #ffffffff;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .reward-thumb i {
        font-size: 2rem;
        color: #9ca3af;
    }

    .btn-outline {
        border: 1px solid var(--border);
        background: #fff;
        color: var(--text-primary);
    }

    .btn-outline:hover {
        background: #f8fafc;
    }

    .hidden {
        display: none !important;
    }
</style>
@endpush

@section('content')
<main class="py-4">
    <div class="container">
        <div class="mb-4">
            <h1 class="h2 fw-bold mb-1">Poin & Hadiah</h1>
            <p class="text-secondary mb-0">
                Tukar poin kontribusimu dengan saldo e-wallet, pulsa, atau voucher menarik lainnya.
            </p>
        </div>

        <div class="row g-3 g-md-4 mb-4 mb-md-5">
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm h-100 p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-icon-primary">
                            <i class="bi bi-stars"></i>
                        </div>
                        <div>
                            <div class="small text-secondary fw-medium">Total Poin</div>
                            <div class="h4 fw-bold mb-0">{{ $totalPoints }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm h-100 p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-icon-success">
                            <i class="bi bi-arrow-down-left"></i>
                        </div>
                        <div>
                            <div class="small text-secondary fw-medium">Poin Masuk</div>
                            <div class="h4 fw-bold mb-0 text-success">+{{ $incomePoints }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm h-100 p-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-icon-danger">
                            <i class="bi bi-bag"></i>
                        </div>
                        <div>
                            <div class="small text-secondary fw-medium">Poin Keluar</div>
                            <div class="h4 fw-bold mb-0 text-danger">-{{ $redeemedPoints }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($rewards as $reward)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 card-hover border rounded-4 overflow-hidden">
                    <div class="card-body d-flex flex-column p-4">
                        <div class="reward-thumb mb-3">
                            @if($reward->thumbnail)
                            <img src="{{ Storage::url($reward->thumbnail) }}" alt="{{ $reward->name }}"
                                class="w-100 h-100 object-fit-contain rounded">
                            @else
                            <i class="bi bi-gift"></i>
                            @endif
                        </div>

                        <h3 class="h6 fw-bold mb-1">{{ $reward->name }}</h3>
                        <div class="d-flex align-items-center text-primary fw-bold mb-3">
                            <i class="bi bi-coin me-1"></i> {{ number_format($reward->point_cost) }} Poin
                        </div>

                        <div class="mt-auto">
                            <form action="{{route('citizen.rewards.redeem', $reward->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary w-100 fw-semibold">
                                    Tukarkan Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5 my-3">
                    <div class="mb-3">
                        <span class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle text-secondary" style="width: 80px; height: 80px; font-size: 2.5rem;">
                            <i class="bi bi-gift-fill"></i>
                        </span>
                    </div>
                    <h4 class="h5 fw-bold text-dark mb-2">Belum Ada Hadiah Tersedia</h4>
                    <p class="text-secondary mx-auto mb-4" style="max-width: 450px;">
                        Saat ini admin belum menambahkan item hadiah.
                        Silakan cek kembali nanti.
                    </p>
                </div>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $rewards->withQueryString()->links() }}
        </div>
    </div>
</main>
@endsection