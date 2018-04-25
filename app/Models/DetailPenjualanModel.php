<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualanModel extends Model
{
    protected $table = 'tbl_detailpenjualan';

    //protected $fillable = ['nama_produk', 'jenis_produk']; //whitelist atau yg boleh diisi
    protected $guarded  = ['created_at']; //blacklist atau yg tidak boleh diisi
}
