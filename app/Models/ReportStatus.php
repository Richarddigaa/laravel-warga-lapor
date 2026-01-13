<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'status',
        'note',
    ];

    // relasi report_status many to one report
    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
