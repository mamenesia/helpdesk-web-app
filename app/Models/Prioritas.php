<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prioritas extends Model
{
    use HasFactory;

    protected $table = 'prioritas';

    protected $fillable = [
        'nama_prioritas',
        'value'
    ];

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }
}