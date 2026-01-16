<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminCitizenController extends Controller
{
    public function index()
    {
        $citizens = User::getAllCitizens();

        return view('admin.citizen.citizen_index', compact('citizens'));
    }

    public function create()
    {
        return view('admin.citizencitizen_create');
    }

    public function store(UserStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $validated = $request->validated();

                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');

                    // 1. Ambil Ekstensi
                    $extension = $file->getClientOriginalExtension();

                    // 2. Susun Nama File
                    // Format: avatar_Acak_Tanggal.ext
                    $fileName = 'avatar_' . Str::random(5) . '_' . now()->format('Ymd_His') . '.' . $extension;

                    // 3. Simpan dengan nama custom
                    $avatarPath = $file->storeAs('avatars', $fileName, 'public');

                    // 4. Masukkan ke array validated
                    $validated['avatar'] = $avatarPath;
                }

                $newUser = User::create([
                    'avatar' => $validated['avatar'],
                    'nik' => $validated['nik'],
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'date_of_birth' => $validated['date_of_birth'],
                    'address' => $validated['address'],
                    'type_of_work' => $validated['type_of_work'],
                    'password' => Hash::make($validated['password']),
                ]);

                $newUser->assignRole('citizen');
            });

            return redirect()->route('admin.citizen.index')->with('alert', [
                'title' => 'Data Warga Berhasil Ditambahkan',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal membuat citizen baru:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat membuat citizen baru. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }

    public function show(User $citizen)
    {
        return view('admin.citizen.citizen_show', compact('citizen'));
    }

    public function edit(User $citizen)
    {
        return view('admin.citizen.citizen_edit', compact('citizen'));
    }

    public function update(UserUpdateRequest $request, User $citizen)
    {
        try {
            DB::transaction(function () use ($request, $citizen) {
                $validated = $request->validated();

                if ($request->hasFile('avatar')) {
                    // Cek apakah user sudah punya avatar lama & file-nya ada di storage
                    if ($citizen->avatar && Storage::disk('public')->exists($citizen->avatar)) {
                        // Hapus file lama
                        Storage::disk('public')->delete($citizen->avatar);
                    }

                    $file = $request->file('avatar');

                    // 1. Ambil Ekstensi
                    $extension = $file->getClientOriginalExtension();

                    // 2. Susun Nama File
                    // Format: avatar_USERID_Acak_Tanggal.ext
                    $fileName = 'avatar_' . $citizen->id . '_' . Str::random(5) . '_' . now()->format('Ymd_His') . '.' . $extension;

                    // 3. Simpan dengan nama custom
                    $avatarPath = $file->storeAs('avatars', $fileName, 'public');

                    // 4. Masukkan ke array validated
                    $validated['avatar'] = $avatarPath;
                }

                $citizen->update($validated);
            });

            return redirect()->route('admin.citizen.index')->with('alert', [
                'title' => 'Data Warga Berhasil Diubah',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengubah citizen:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat mengubah citizen. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }

    public function destroy(User $citizen)
    {
        try {
            DB::transaction(function () use ($citizen) {
                $citizen->delete();
            });

            return redirect()->route('admin.citizen.index')->with('alert', [
                'title' => 'Data Warga Berhasil Dihapus',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus citizen:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat menghapus citizen. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }
}
