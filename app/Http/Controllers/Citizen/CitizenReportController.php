<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportStoreRequest;
use App\Models\Category;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CitizenReportController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data kategori untuk filter dropdown
        $categories = Category::getAllCategories();

        // Buat query untuk mengambil laporan
        $query = Report::with('statuses')->latest();

        // Terapkan filter pencarian jika ada
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('location', 'like', '%' . $request->q . '%')
                    ->orWhere('code', 'like', '%' . $request->q . '%');
            });
        }

        // Terapkan filter kategori jika ada
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Terapkan filter status jika ada
        if ($request->filled('status')) {
            $query->whereHas('statuses', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        // Terapkan filter jenis laporan
        if ($request->filled('type') && $request->type == 'me') {
            // Pastikan user login agar tidak error
            if (Auth::check()) {
                $query->where('user_id', Auth::id());
            } else {
                // Jika tamu iseng pilih filter ini, kembalikan hasil kosong atau abaikan
                // Di sini saya pilih kembalikan kosong
                $query->where('id', null);
            }
        }

        // Lakukan pagination
        $reports = $query->paginate(9)->withQueryString();

        return view('citizen.reports.report_index', compact('reports', 'categories'));
    }

    public function create()
    {
        $categories = Category::getAllCategories();

        return view('citizen.reports.report_create', compact('categories'));
    }

    public function store(ReportStoreRequest $request)
    {
        $user = Auth::user();

        try {
            DB::transaction(function () use ($request, $user) {
                $validated = $request->validated();

                $code = '';
                do {
                    // Format: LP-YYMMDD-5CHAR
                    $datePart = now()->format('ymd');
                    $randomPart = Str::upper(Str::random(5));
                    $code = "LP-{$datePart}-{$randomPart}";

                    // Cek ke database untuk memastikan kode belum ada
                } while (Report::where('code', $code)->exists());

                $validated['code'] = $code;
                $validated['user_id'] = $user->id;
                $validated['latest_status'] = 'pending';

                $report = Report::create($validated);

                // status laporan
                $report->statuses()->create([
                    'status' => 'pending',
                    'note'   => 'Laporan telah diterima dan sedang menunggu verifikasi.',
                ]);

                // Menyimpan beberapa foto/video
                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {

                        // 1. Ambil Ekstensi File (jpg, png, mp4, dll)
                        $extension = $file->getClientOriginalExtension();

                        // 2. Susun Nama File Custom
                        // Format: reportID_userID_randomString_tanggal.ext
                        $fileName = $report->id . '_' . Auth::id() . '_' . Str::random(5) . '_' . now()->format('Ymd_His') . '.' . $extension;

                        // 3. Simpan menggunakan storeAs
                        // Parameter: (Folder, Nama File Custom, Disk)
                        $path = $file->storeAs('reports', $fileName, 'public');

                        // 4. Tentukan tipe file (image atau video)
                        $type = Str::startsWith($file->getMimeType(), 'image') ? 'image' : 'video';

                        // 5. Simpan informasi file ke tabel report_files
                        $report->files()->create([
                            'media_path' => $path,
                            'type' => $type,
                        ]);
                    }
                }
            });

            return redirect()->route('citizen.reports.index')->with('alert', [
                'title' => 'Laporan Berhasil Dibuat',
                'type' => 'success',
            ]);;
        } catch (\Exception $e) {
            Log::error('Gagal membuat laporan baru:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat membuat laporan. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }

    public function show(Report $report)
    {
        $report->load(['user', 'category', 'files', 'statuses']);

        // Kirim data ke view
        return view('citizen.reports.report_show', ['report' => $report]);
    }

    public function destroy(Report $report)
    {
        try {
            DB::transaction(function () use ($report) {
                $report->delete();
            });

            return redirect()->route('citizen.reports.index')->with('alert', [
                'title' => 'Laporan Berhasil Dihapus',
                'type' => 'success',
            ]);;
        } catch (\Exception $e) {
            Log::error('Gagal menghapus laporan:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat menghapus laporan. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }
}
