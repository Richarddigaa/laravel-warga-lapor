<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reward_id',
        'point_cost',
    ];

    // relasi redemption one to one reward
    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}
