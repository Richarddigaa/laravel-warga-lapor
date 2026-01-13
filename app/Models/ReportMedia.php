<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'media_path',
        'type',
    ];

    // relasi report_media many to one report
    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
