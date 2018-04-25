<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use App\Models\PelangganModel;
use App\Models\KaryawanModel;

class PenjualanController extends Controller
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
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Penjualan',
            'breadcrumbchild' => 'Penjualan',
            'loginuser' => 'User',
            'pageurl' => 'penjualan',
            'penjualans' => $penjualans,
            'pelanggans' => $pelanggans,
            'karyawans' => $karyawans,
            'editpenjualans' => '',
            'flag' => '',
        );
        return view('pages.penjualan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penjualans = PenjualanModel::all();
        $pelanggans = PelangganModel::all();
        $karyawans = KaryawanModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Penjualan',
            'breadcrumbchild' => 'Penjualan',
            'loginuser' => 'User',
            'pageurl' => 'penjualan',
            'penjualans' => $penjualans,
            'pelanggans' => $pelanggans,
            'karyawans' => $karyawans,
            'editpenjualans' => '',
            'flag' => '',
        );
        return view('pages.formpenjualan', $data);
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
        PenjualanModel::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_karyawan' => $request->id_karyawan,
            'tanggal_penjualan' => date('Y-m-d', strtotime($request->tanggal_penjualan)),
            'status' => "0",
            'total' => $request->total,
        ]);

        $penjualans = PenjualanModel::all();
        $pelanggans = PelangganModel::all();
        $karyawans = KaryawanModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Penjualan',
            'breadcrumbchild' => 'Penjualan',
            'loginuser' => 'User',
            'pageurl' => 'penjualan',
            'penjualans' => $penjualans,
            'pelanggans' => $pelanggans,
            'karyawans' => $karyawans,
            'editpenjualans' => '',
            'flag' => '0',
        );
        return view('pages.penjualan', $data);
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
        $penjualans = PenjualanModel::all();
        $pelanggans = PelangganModel::all();
        $karyawans = KaryawanModel::all();

        $editpenjualans = PenjualanModel::where('id_penjualan',$id)->first();
        //dd($editpenjualans);
        if(!$editpenjualans)
            abort(404);

        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Penjualan',
            'breadcrumbchild' => 'Penjualan',
            'loginuser' => 'User',
            'pageurl' => 'penjualan',
            'penjualans' => $penjualans,
            'pelanggans' => $pelanggans,
            'karyawans' => $karyawans,
            'editpenjualans' => $editpenjualans,
            'flag' => '',
        );
        //dd($data);
        return view('pages.formpenjualan', $data);
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
        //dd($id);
        PenjualanModel::where('id_penjualan', $id)->update([
            'id_pelanggan' => $request->id_pelanggan,
            'id_karyawan' => $request->id_karyawan,
            'tanggal_penjualan' => date('Y-m-d', strtotime($request->tanggal_penjualan)),
            'total' => $request->total,
        ]);

        $penjualans = PenjualanModel::all();
        $pelanggans = PelangganModel::all();
        $karyawans = KaryawanModel::all();

        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Penjualan',
            'breadcrumbchild' => 'Penjualan',
            'loginuser' => 'User',
            'pageurl' => 'penjualan',
            'penjualans' => $penjualans,
            'pelanggans' => $pelanggans,
            'karyawans' => $karyawans,
            'editpenjualans' => '',
            'flag' => '1',
        );
        return view('pages.penjualan', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penjualan = PenjualanModel::where('id_penjualan', $id)->delete();
        return json_encode(array('urlpenjualan' => 'penjualan'));
    }
}
