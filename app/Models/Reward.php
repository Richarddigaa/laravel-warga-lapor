<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail',
        'type',
        'point_cost',
        'stock',
        'is_active',
    ];

    // untuk menghapus file reward yang ada di file storage ketika reward dihapus
    protected static function booted()
    {
        // 1. Event saat MENGHAPUS data (Deleting)
        static::deleting(function ($reward) {
            // Cek apakah ada path thumbnail dan apakah file fisiknya ada di disk 'public'
            if ($reward->thumbnail && Storage::disk('public')->exists($reward->thumbnail)) {
                Storage::disk('public')->delete($reward->thumbnail);
            }
        });

        // 2. Event saat MENGUPDATE data (Updating)
        // Gunanya: Jika admin mengganti gambar reward, gambar lama dihapus agar tidak menumpuk
        static::updating(function ($reward) {
            // Cek apakah kolom 'thumbnail' berubah isinya
            if ($reward->isDirty('thumbnail')) {
                // Ambil path thumbnail yang lama
                $oldThumbnail = $reward->getOriginal('thumbnail');

                // Hapus file lama jika ada
                if ($oldThumbnail && Storage::disk('public')->exists($oldThumbnail)) {
                    Storage::disk('public')->delete($oldThumbnail);
                }
            }
        });
    }

    // relasi reward one to many redemption
    public function redeemed()
    {
        return $this->hasMany(Redemption::class);
    }

    // query untuk mengambil semua reward
    public static function getAllRewards()
    {
        return Reward::orderBy('created_at', 'desc')->get();
    }

    // query untuk mengambil status reward aktif, stock > 0, dan paginate
    public static function getAllRewardsPaginate()
    {
        return Reward::where('is_active', true)
            ->where('stock', '>', 0)
            ->paginate(6);
    }
}
