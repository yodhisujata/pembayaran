<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KaryawanModel;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = KaryawanModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Karyawan',
            'breadcrumbchild' => 'Karyawan',
            'loginuser' => 'User',
            'pageurl' => 'karyawan',
            'karyawans' => $karyawans,
            'editkaryawan' => '',
            'flag' => '',
        );
        return view('pages.admin.karyawan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $karyawans = KaryawanModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Karyawan',
            'breadcrumbchild' => 'Karyawan',
            'loginuser' => 'User',
            'pageurl' => 'karyawan',
            'karyawans' => $karyawans,
            'editkaryawan' => '',
            'flag' => '',
        );
        return view('pages.admin.formkaryawan', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        KaryawanModel::create([
            'id_karyawan' => $request->id_karyawan,
            'nama_karyawan' => $request->nama_karyawan,
            'alamat'        => $request->alamat,
            'no_telp'       => $request->no_telp,
            'email'         => $request->email,
            'jabatan'       => $request->jabatan,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)),
            'jenis_kelamin' => $request->jenis_kelamin,
            'status'        => $request->status,
            'bekerja_sejak' => date('Y-m-d', strtotime($request->bekerja_sejak)),
        ]);

        $karyawans = KaryawanModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Karyawan',
            'breadcrumbchild' => 'Karyawan',
            'loginuser' => 'User',
            'pageurl' => 'karyawan',
            'karyawans' => $karyawans,
            'editkaryawan' => '',
            'flag' => '0',
        );
        return view('pages.admin.karyawan', $data);
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
        $karyawans = KaryawanModel::all();
        
        $editkaryawans = KaryawanModel::where('id_karyawan',$id)->first();
        //dd($editkaryawans);
        if(!$editkaryawans)
            abort(404);

        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Karyawan',
            'breadcrumbchild' => 'Karyawan',
            'loginuser' => 'User',
            'pageurl' => 'karyawan',
            'karyawans' => $karyawans,
            'editkaryawans' => $editkaryawans,
            'flag' => '',
        );
        //dd($data);
        return view('pages.admin.formkaryawan', $data);
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
        //dd($request);
        KaryawanModel::where('id_karyawan', $id)->update([
            'nama_karyawan' => $request->nama_karyawan,
            'alamat'        => $request->alamat,
            'no_telp'       => $request->no_telp,
            'email'         => $request->email,
            'jabatan'       => $request->jabatan,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)),
            'jenis_kelamin' => $request->jenis_kelamin,
            'status'        => $request->status,
            'bekerja_sejak' => date('Y-m-d', strtotime($request->bekerja_sejak)),
        ]);

        $karyawans = KaryawanModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Karyawan',
            'breadcrumbchild' => 'Karyawan',
            'loginuser' => 'User',
            'pageurl' => 'karyawan',
            'karyawans' => $karyawans,
            'editkaryawan' => '',
            'flag' => '1',
        );
        return view('pages.admin.karyawan', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = KaryawanModel::where('id_karyawan', $id)->delete();
        return json_encode(array('urlkaryawan' => 'karyawan'));
    }
}
