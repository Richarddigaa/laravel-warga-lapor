<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CitizenProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('citizen.profile.profile_index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('citizen.profile.profile_edit', compact('user'));
    }

    public function update(UserUpdateRequest $request)
    {
        try {
            $user = Auth::user();

            DB::transaction(function () use ($request, $user) {
                $validated = $request->validated();

                if ($request->hasFile('avatar')) {
                    // Cek apakah user sudah punya avatar lama & file-nya ada di storage
                    if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                        // Hapus file lama
                        Storage::disk('public')->delete($user->avatar);
                    }

                    $file = $request->file('avatar');

                    // 1. Ambil Ekstensi
                    $extension = $file->getClientOriginalExtension();

                    // 2. Susun Nama File
                    // Format: avatar_USERID_Acak_Tanggal.ext
                    $fileName = 'avatar_' . $user->id . '_' . Str::random(5) . '_' . now()->format('Ymd_His') . '.' . $extension;

                    // 3. Simpan dengan nama custom
                    $avatarPath = $file->storeAs('avatars', $fileName, 'public');

                    // 4. Masukkan ke array validated
                    $validated['avatar'] = $avatarPath;
                }

                $user->update($validated);
            });

            return redirect()->route('citizen.profile.index')->with('alert', [
                'title' => 'Profile Berhasil Diubah',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal melakukan perubahan profile:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat perubahan profile. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }
}
