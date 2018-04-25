<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembayaranModel;
use App\Models\PenjualanModel;
use App\Models\PelangganModel;
use App\Models\KaryawanModel;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualans = PenjualanModel::all();
        $pelanggans = PelangganModel::all();
        $karyawans = KaryawanModel::all();
        $detailpembayarans = PembayaranModel::all();

        $totalbayars = PenjualanModel::leftJoin('tbl_pembayaran', 'tbl_penjualan.id_penjualan', '=', 'tbl_pembayaran.id_penjualan')->selectRaw('tbl_penjualan.id_penjualan, sum(tbl_pembayaran.jumlah_bayar) as totalbayar')->groupBy('id_penjualan')->get();
        //dd($totalbayars);
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Pembayaran',
            'breadcrumbchild' => 'Pembayaran',
            'loginuser' => 'User',
            'pageurl' => 'pembayaran',
            'pembayarans' => $penjualans,
            'detailpembayarans' => $detailpembayarans,
            'pelanggans' => $pelanggans,
            'karyawans' => $karyawans,
            'totalbayars' => $totalbayars,
            'editpenjualans' => '',
            'flag' => '',
        );
        return view('pages.pembayaran', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $sisahutang = $request->sisa_hutang - $request->jumlah_bayar;
        PembayaranModel::create([
            'id_penjualan' => $request->id_penjualan,
            'id_karyawan' => $request->id_karyawan,
            'jumlah_bayar' => $request->jumlah_bayar,
            'sisa_hutang' => $sisahutang,
            'tanggal_pembayaran' => date('Y-m-d'),
            'status' => "0",
        ]);

        if($sisahutang <= 0)
        {
            PenjualanModel::where('id_penjualan', $request->id_penjualan)->update([
                'status' => "1",
            ]);
        }

        $penjualans = PenjualanModel::all();
        $pelanggans = PelangganModel::all();
        $karyawans = KaryawanModel::all();
        $detailpembayarans = PembayaranModel::all();

        $totalbayars = PenjualanModel::leftJoin('tbl_pembayaran', 'tbl_penjualan.id_penjualan', '=', 'tbl_pembayaran.id_penjualan')->selectRaw('tbl_penjualan.id_penjualan, sum(tbl_pembayaran.jumlah_bayar) as totalbayar')->groupBy('id_penjualan')->get();
        //dd($totalbayars);
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Pembayaran',
            'breadcrumbchild' => 'Pembayaran',
            'loginuser' => 'User',
            'pageurl' => 'pembayaran',
            'pembayarans' => $penjualans,
            'detailpembayarans' => $detailpembayarans,
            'pelanggans' => $pelanggans,
            'karyawans' => $karyawans,
            'totalbayars' => $totalbayars,
            'editpenjualans' => '',
            'flag' => '0',
        );
        return view('pages.pembayaran', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
