<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'code',
        'title',
        'description',
        'location',
        'latitude',
        'longitude',
        'latest_status'
    ];

    // untuk menghapus file laporan yang ada di file storage ketika laporan dihapus
    protected static function booted(): void
    {
        static::deleting(function ($report) {
            // Loop semua file yang berelasi dengan laporan ini
            foreach ($report->files as $file) {
                // Cek apakah file ada di storage public, lalu hapus
                if ($file->media_path && Storage::disk('public')->exists($file->media_path)) {
                    Storage::disk('public')->delete($file->media_path);
                }
            }
        });
    }

    // relasi report many to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi report many to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // relasi report one to many report_media
    public function files()
    {
        return $this->hasMany(ReportMedia::class);
    }

    // relasi report one to many report_status
    public function statuses()
    {
        return $this->hasMany(ReportStatus::class);
    }

    // relasi report one to many point_ledger
    public function ledgers()
    {
        return $this->hasMany(PointLedger::class, 'source_id')
            ->whereIn('source_type', ['report_verified', 'report_resolved']);
    }

    // query untuk mengambil semua laporan
    public static function getAllReports()
    {
        return Report::with([
            'user',
            'category',
            'files',
            'statuses',
            'ledgers'
        ])->orderBy('created_at', 'desc')->get();
    }

    // query untuk mengambil semua laporan milik user
    public static function getUserReports()
    {
        return Report::with(['user'])->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
    }

    // query untuk mengambil laporan yang sudah diverifikasi
    public static function getVerifiedReports()
    {
        return Report::where('latest_status', 'verified')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // query untuk mengambil laporan yang sedang diproses
    public static function getInProgressReports()
    {
        return Report::where('latest_status', 'in_progress')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // query untuk mengambil laporan yang sudah diselesaikan
    public static function getResolvedReports()
    {
        return Report::where('latest_status', 'resolved')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // query untuk mengambil laporan yang ditolak
    public static function getRejectedReports()
    {
        return Report::where('latest_status', 'rejected')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Accessor untuk mendapatkan ringkasan poin.
     * Cara panggil: $report->points_summary
     */
    public function getPointsSummaryAttribute()
    {
        // Menggunakan properti 'ledgers' yang sudah di-load (atau akan di-lazy load)
        // agar tidak melakukan query berulang-ulang.

        $verifiedPoints = $this->ledgers
            ->where('source_type', 'report_verified')
            ->sum('points');

        $resolvedPoints = $this->ledgers
            ->where('source_type', 'report_resolved')
            ->sum('points');

        return [
            'verified' => $verifiedPoints,
            'resolved' => $resolvedPoints,
            'total'    => $verifiedPoints + $resolvedPoints,
        ];
    }
}
