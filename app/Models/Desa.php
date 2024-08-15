<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'indonesia_villages';

    protected $fillable = [
        'code',
        'district_code',
        'name',
        'meta'
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
