<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointLedger extends Model
{
    protected $fillable = [
        'user_id',
        'points',
        'source_type',
        'source_id',
    ];

    // relasi point_ledger one to one user
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // relasi point_ledger one to one report
    public function report()
    {
        return $this->belongsTo(Report::class, 'source_id');
    }

    // relasi point_ledger one to one redemption
    public function redemption()
    {
        return $this->belongsTo(Redemption::class, 'source_id');
    }

    // query untuk menghitung total poin yang pernah di redeem yang user punya
    public static function getTotalRedeemedPoints($userId)
    {
        return self::where('user_id', $userId)
            ->where('source_type', 'redemption')
            ->sum('points');
    }

    // query untuk menghitung total poin yang pernah masuk dari laporan yang user punya
    public static function getTotalIncomePoints($userId)
    {
        return self::where('user_id', $userId)
            ->whereIn('source_type', ['report_verified', 'report_resolved'])
            ->sum('points');
    }

    // query untuk menghitung total point dari laporan dan redeem yang user punya
    public static function getTotalPoints($userId)
    {
        $income = self::getTotalIncomePoints($userId);

        $expense = self::getTotalRedeemedPoints($userId);

        return $income - $expense;
    }
}
