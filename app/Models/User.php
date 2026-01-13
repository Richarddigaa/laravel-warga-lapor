<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'avatar',
        'nik',
        'name',
        'phone',
        'date_of_birth',
        'type_of_work',
        'address',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // untuk menghapus file user yang ada di file storage ketika user dihapus
    protected static function booted()
    {
        // 1. Event saat MENGHAPUS data (Deleting)
        static::deleting(function ($user) {
            // Cek apakah ada path avatar dan apakah file fisiknya ada di disk 'public'
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
        });

        // 2. Event saat MENGUPDATE data (Updating)
        // Gunanya: Jika admin mengganti gambar user, gambar lama dihapus agar tidak menumpuk
        static::updating(function ($user) {
            // Cek apakah kolom 'avatar' berubah isinya
            if ($user->isDirty('avatar')) {
                // Ambil path avatar yang lama
                $oldAvatar = $user->getOriginal('avatar');

                // Hapus file lama jika ada
                if ($oldAvatar && Storage::disk('public')->exists($oldAvatar)) {
                    Storage::disk('public')->delete($oldAvatar);
                }
            }
        });
    }

    // relasi user one to many report
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // relasi user one to many redemption
    public function redeemed()
    {
        return $this->hasMany(Redemption::class);
    }

    // relasi user one to many point_ledger
    public function points()
    {
        return $this->hasMany(PointLedger::class);
    }

    // query untuk mengambil semua role citizen (warga)
    public static function getAllCitizens()
    {
        return User::role('citizen')->with(['reports', 'redeemed', 'points'])->orderBy('created_at', 'desc')->get();
    }

    // function untuk menghitung poin yang user punya
    public function getCurrentPoints()
    {
        return PointLedger::getTotalPoints($this->id);
    }
}
