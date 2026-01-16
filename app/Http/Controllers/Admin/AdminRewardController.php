<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RewardStoreRequest;
use App\Http\Requests\RewardUpdateRequest;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminRewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::getAllRewards();

        return view('admin.rewards.reward_index', compact('rewards'));
    }

    public function create()
    {
        return view('admin.rewards.reward_create');
    }

    public function store(RewardStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $validated = $request->validated();

                if ($request->hasFile('thumbnail')) {
                    $file = $request->file('thumbnail');

                    // 1. Ambil Ekstensi
                    $extension = $file->getClientOriginalExtension();

                    // 2. Susun Nama File
                    // Format: thumbnail_Acak_Tanggal.ext
                    $fileName = 'thumbnail_' . Str::random(5) . '_' . now()->format('Ymd_His') . '.' . $extension;

                    // 3. Simpan dengan nama custom
                    $thumbnailPath = $file->storeAs('thumbnails', $fileName, 'public');

                    // 4. Masukkan ke array validated
                    $validated['thumbnail'] = $thumbnailPath;
                }

                $newRewards = Reward::create($validated);
            });

            return redirect()->route('admin.rewards.index')->with('alert', [
                'title' => 'Data Hadiah Berhasil Ditambahkan',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal membuat hadiah baru:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat membuat hadiah. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }

    public function edit(Reward $reward)
    {
        return view('admin.rewards.reward_edit', compact('reward'));
    }

    public function update(RewardUpdateRequest $request, Reward $reward)
    {
        try {
            DB::transaction(function () use ($request, $reward) {
                $validated = $request->validated();

                if ($request->hasFile('thumbnail')) {
                    // Cek apakah user sudah punya thumbnail lama & file-nya ada di storage
                    if ($reward->thumbnail && Storage::disk('public')->exists($reward->thumbnail)) {
                        // Hapus file lama
                        Storage::disk('public')->delete($reward->thumbnail);
                    }

                    $file = $request->file('thumbnail');

                    // 1. Ambil Ekstensi
                    $extension = $file->getClientOriginalExtension();

                    // 2. Susun Nama File
                    // Format: thumbnail_REWARDID_Acak_Tanggal.ext
                    $fileName = 'thumbnail_' . $reward->id . '_' . Str::random(5) . '_' . now()->format('Ymd_His') . '.' . $extension;

                    // 3. Simpan dengan nama custom
                    $thumbnailPath = $file->storeAs('thumbnails', $fileName, 'public');

                    // 4. Masukkan ke array validated
                    $validated['thumbnail'] = $thumbnailPath;
                }

                $reward->update($validated);
            });

            return redirect()->route('admin.rewards.index')->with('alert', [
                'title' => 'Data Hadiah Berhasil Diubah',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengubah hadiah:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat mengubah hadiah. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }

    public function destroy(Reward $reward)
    {
        try {
            DB::transaction(function () use ($reward) {
                $reward->delete();
            });

            return redirect()->route('admin.rewards.index')->with('alert', [
                'title' => 'Data Hadiah Berhasil Dihapus',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus hadiah:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat menghapus hadiah. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }
}
