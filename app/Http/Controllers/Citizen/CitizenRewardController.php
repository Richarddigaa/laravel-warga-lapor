<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Models\PointLedger;
use App\Models\Redemption;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CitizenRewardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $incomePoints = PointLedger::getTotalIncomePoints($user->id);
        $redeemedPoints = PointLedger::getTotalRedeemedPoints($user->id);
        $totalPoints = PointLedger::getTotalPoints($user->id);

        $rewards = Reward::getAllRewardsPaginate();

        return view('citizen.rewards.reward_index', compact(
            'totalPoints',
            'incomePoints',
            'redeemedPoints',
            'rewards'
        ));
    }

    public function redeem(Reward $reward)
    {
        $user = Auth::user();

        // 1. Validasi: Cek apakah hadiah aktif dan stok masih ada
        if (!$reward->is_active || $reward->stock <= 0) {
            return back()->with('alert', [
                'title' => 'Maaf, stok hadiah ini sudah habis atau tidak aktif.',
                'type' => 'error',
            ]);
        }

        // 2. Validasi: Cek kecukupan poin user
        // Menggunakan fungsi helper static yang sudah kita buat sebelumnya
        $currentBalance = PointLedger::getTotalPoints($user->id);

        if ($currentBalance < $reward->point_cost) {
            return back()->with('alert', [
                'title' => 'Poin Anda ' . $currentBalance . ' tidak mencukupi untuk hadiah ini ' . $reward->point_cost . '.',
                'type' => 'error',
            ]);
        }

        try {
            DB::transaction(function () use ($reward, $user) {

                // A. Simpan ke tabel redemptions
                $redemption = Redemption::create([
                    'user_id'    => $user->id,
                    'reward_id'  => $reward->id,
                    'point_cost' => $reward->point_cost,
                ]);

                // B. Simpan ke tabel point_ledgers (Pencatatan Poin Keluar)
                PointLedger::create([
                    'user_id'     => $user->id,
                    'points'      => $reward->point_cost, // Simpan angka positif, nanti logic getTotalRedeemedPoints yang menghitungnya sebagai pengeluaran
                    'source_type' => 'redemption',        // Penanda bahwa ini adalah pengeluaran
                    'source_id'   => $redemption->id,     // Relasi ke tabel redemption
                ]);

                // C. Kurangi Stok Hadiah
                $reward->decrement('stock');
            });

            return redirect()->route('citizen.rewards.index')->with('alert', [
                'title' => 'Selamat! Anda berhasil menukarkan poin dengan ' . $reward->name,
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal melakukan penukaran hadiah:', ['message' => $e->getMessage()]);

            return back()->with('alert', [
                'title' => 'Terjadi kesalahan sistem saat memproses penukaran. Silakan coba lagi.',
                'type' => 'error',
            ]);
        }
    }
}
