<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenjualanModel extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_penjualan';
    protected $dates = ['deleted_at'];

    //protected $fillable = ['nama_produk', 'jenis_produk']; //whitelist atau yg boleh diisi
    protected $guarded  = ['created_at']; //blacklist atau yg tidak boleh diisi
}
