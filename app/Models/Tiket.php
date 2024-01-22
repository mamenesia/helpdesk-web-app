<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tiket';

    protected $fillable = [
        'judul',
        'pengaju',
        'aplikasi',
        'deskripsi',
        'prioritas_id',
        'divisi_id',
        'user_id',
        'status_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function prioritas()
    {
        return $this->belongsTo(Prioritas::class, 'prioritas_id');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
    public function balasan()
    {
        return $this->hasMany(Reply::class, 'tiket_id');
    }
    public function file()
    {
        return $this->hasMany(File::class, 'tiket_id');
    }
    public $timestamps = true;
}
