<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggans = PelangganModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Pelanggan',
            'breadcrumbchild' => 'Pelanggan',
            'loginuser' => 'User',
            'pageurl' => 'pelanggan',
            'pelanggans' => $pelanggans,
            'editpelanggans' => '',
            'flag' => '',
        );
        return view('pages.admin.pelanggan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggans = PelangganModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Pelanggan',
            'breadcrumbchild' => 'Pelanggan',
            'loginuser' => 'User',
            'pageurl' => 'pelanggan',
            'pelanggans' => $pelanggans,
            'editpelanggans' => '',
            'flag' => '',
        );
        return view('pages.admin.formpelanggan', $data);
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
        PelangganModel::create([
            'nama_toko' => $request->nama_toko,
            'nama_pemilik' => $request->nama_pemilik,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'status' => $request->status,
        ]);

        $pelanggans = PelangganModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Pelanggan',
            'breadcrumbchild' => 'Pelanggan',
            'loginuser' => 'User',
            'pageurl' => 'pelanggan',
            'pelanggans' => $pelanggans,
            'editpelanggans' => '',
            'flag' => '0',
        );
        return view('pages.admin.pelanggan', $data);
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
        $pelanggans = PelangganModel::all();

        $editpelanggans = PelangganModel::where('id_pelanggan',$id)->first();
        //dd($editproduks);
        if(!$editpelanggans)
            abort(404);

        $pelanggans = PelangganModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Pelanggan',
            'breadcrumbchild' => 'Pelanggan',
            'loginuser' => 'User',
            'pageurl' => 'pelanggan',
            'pelanggans' => $pelanggans,
            'editpelanggans' => $editpelanggans,
            'flag' => '',
        );
        return view('pages.admin.formpelanggan', $data);
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
        PelangganModel::where('id_pelanggan', $id)->update([
            'nama_toko' => $request->nama_toko,
            'nama_pemilik' => $request->nama_pemilik,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'status' => $request->status,
        ]);

        $pelanggans = PelangganModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Pelanggan',
            'breadcrumbchild' => 'Pelanggan',
            'loginuser' => 'User',
            'pageurl' => 'pelanggan',
            'pelanggans' => $pelanggans,
            'editpelanggans' => '',
            'flag' => '1',
        );
        return view('pages.admin.pelanggan', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = PelangganModel::where('id_pelanggan', $id)->delete();
        return json_encode(array('urlpelanggan' => 'pelanggan'));
    }
}
