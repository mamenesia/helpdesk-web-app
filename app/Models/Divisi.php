<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';

    protected $fillable = [
        'nama_divisi'
    ];

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}