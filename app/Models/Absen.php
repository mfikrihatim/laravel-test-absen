<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Absen extends Model implements Authenticatable{
    use AuthenticableTrait;
    // use SoftDeletes;
    protected $primaryKey = "id_absen";
    protected $table = "absen";
    // protected $fillable = ['id_absen', 'fk_id_users', 'nama_user', 'masuk', 'izin', 'keterangan', 'tanggal', 'waktu_absen', 'waktu_keluar'];
    protected $fillable = ['nama_user', 'keterangan'];

    public function user()
    {
        return $this->belongsTo(Users::class, 'fk_id_users', 'id_users');
    }
}
