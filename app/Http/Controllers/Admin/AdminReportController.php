<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportStatusUpdateRequest;
use App\Http\Requests\ReportStoreRequest;
use App\Models\Category;
use App\Models\PointLedger;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminReportController extends Controller
{
    public function index()
    {
        $reports = Report::getAllReports();

        return view('admin.reports.report_index', compact('reports'));
    }

    public function create()
    {
        $categories = Category::getAllCategories();

        return view('admin.reports.report_create', compact('categories'));
    }

    public function store(ReportStoreRequest $request)
    {
        $user = Auth::user();

        try {
            $report = DB::transaction(function () use ($request, $user) {
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

                return $report;
            });

            return redirect()->route('admin.reports.show', $report->id)->with('alert', [
                'title' => 'Laporan Berhasil Dibuat',
                'type' => 'success',
            ]);
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
        $report->load(['user', 'category', 'files', 'statuses', 'ledgers']);

        return view('admin.reports.report_show', ['report' => $report]);
    }

    public function destroy(Report $report)
    {
        try {
            DB::transaction(function () use ($report) {
                $report->delete();
            });

            return redirect()->route('admin.reports.index')->with('alert', [
                'title' => 'Laporan Berhasil Dihapus',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus laporan:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat menghapus laporan. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }

    public function updateStatus(ReportStatusUpdateRequest $request, Report $report)
    {
        try {
            DB::transaction(function () use ($request, $report) {
                $validated = $request->validated();

                $newStatus = $validated['status'];

                // simpan riwayat status
                $report->statuses()->create($validated);

                // update status utama laporan
                $report->update([
                    'latest_status' => $newStatus
                ]);

                // point yang didapat saat status berubah
                $pointsToAdd = 0;
                $sourceType = null;

                if ($newStatus === 'verified') {
                    $pointsToAdd = rand(100, 500);
                    $sourceType = 'report_verified';
                } elseif ($newStatus === 'resolved') {
                    $pointsToAdd = rand(300, 800);
                    $sourceType = 'report_resolved';
                }

                // Jika status yang dipilih berhak dapat poin
                if ($pointsToAdd > 0) {

                    // CEK DUPLIKASI: Pastikan user belum pernah dapat poin untuk status ini di laporan ini
                    $alreadyAwarded = PointLedger::where('source_type', $sourceType)
                        ->where('source_id', $report->id)
                        ->exists();

                    if (!$alreadyAwarded) {
                        PointLedger::create([
                            'user_id'     => $report->user_id,
                            'points'      => $pointsToAdd,
                            'source_type' => $sourceType,
                            'source_id'   => $report->id,
                        ]);
                    }
                }
            });

            return redirect()->route('admin.reports.show', $report->id)->with('alert', [
                'title' => 'Status Laporan Berhasil Diubah',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengubah status laporan:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat mengubah status laporan. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }
}
