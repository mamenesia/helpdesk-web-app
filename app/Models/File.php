<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $fillable = [
        'uuid',
        'nama_file',
        'nama_server',
        'size',
        'mime',
        'path',
        'extension',
        'disk',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function url(): ?string
    {
        if ($this->disk === 'public') {
            return Storage::disk($this->disk)->url($this->path . DIRECTORY_SEPARATOR . $this->server_name);
        }
        return null;
    }
    public function tiket()
    {
        return $this->hasOne(Tiket::class);
    }
    public $timestamps = true;
}
