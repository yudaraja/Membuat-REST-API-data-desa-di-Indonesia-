<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'indonesia_districts';

    protected $fillable = [
        'code',
    ];

    public function desa()
    {
        return $this->hasMany(Desa::class);
    }
}
