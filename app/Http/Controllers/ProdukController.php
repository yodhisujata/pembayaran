<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;
use App\Models\JenisProdukModel;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produks = ProdukModel::all();
        $jenisproduks = JenisProdukModel::all();

        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Produk',
            'breadcrumbchild' => 'Produk',
            'loginuser' => 'User',
            'pageurl' => 'produk',
            'produks' => $produks,
            'jenisproduks' => $jenisproduks,
            'editproduks' => '',
            'flag' => '',
        );
        return view('pages.admin.produk', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = ProdukModel::all();
        $jenisproduks = JenisProdukModel::all();

        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Produk',
            'breadcrumbchild' => 'Produk',
            'loginuser' => 'User',
            'pageurl' => 'produk',
            'produks' => $produks,
            'jenisproduks' => $jenisproduks,
            'editproduks' => '',
            'flag' => '',
        );
        return view('pages.admin.formproduk', $data);
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
        $idjenisproduks = JenisProdukModel::where("id_jenisproduk",$request->id_jenisproduk)->get();
        foreach ($idjenisproduks as $data) {
            $letterid = $data->letterid;
        }

        $idproduks = ProdukModel::where("id_produk","like",$letterid."%")->max("id_produk");
        //dd($idproduks);
        if($idproduks == "")
            $idproduks = $letterid . "0001";

        $id = substr($idproduks, 1);
        //dd($id);
        $lastno = $id + 1;

        //dd($lastno);
        if(strlen($lastno) == 1)
            $idproduk = $letterid. "000" . $lastno;
        else if(strlen($lastno) == 2)
            $idproduk = $letterid. "00" . $lastno;
        else if(strlen($lastno) == 3)
            $idproduk = $letterid. "0" . $lastno;
        else if(strlen($lastno) == 4)
            $idproduk = $letterid. "" . $lastno;

        //dd($idproduk);
        ProdukModel::create([
            'id_produk' => $idproduk,
            'nama_produk' => $request->nama_produk,
            'id_jenisproduk' => $request->id_jenisproduk,
            'harga_produk' => $request->harga_produk,
            'jumlah_tersedia' => $request->jumlah_tersedia,
            'status' => $request->status,
        ]);

        $produks = ProdukModel::all();
        $jenisproduks = JenisProdukModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Produk',
            'breadcrumbchild' => 'Produk',
            'loginuser' => 'User',
            'pageurl' => 'produk',
            'produks' => $produks,
            'jenisproduks' => $jenisproduks,
            'editproduk' => '',
            'flag' => '0',
        );
        return view('pages.admin.produk', $data);
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
        $produks = ProdukModel::all();
        $jenisproduks = JenisProdukModel::all();

        $editproduks = ProdukModel::where('id_produk',$id)->first();
        //dd($editproduks);
        if(!$editproduks)
            abort(404);

        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Produk',
            'breadcrumbchild' => 'Produk',
            'loginuser' => 'User',
            'pageurl' => 'produk',
            'produks' => $produks,
            'jenisproduks' => $jenisproduks,
            'editproduks' => $editproduks,
            'flag' => '',
        );
        //dd($data);
        return view('pages.admin.formproduk', $data);
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
        ProdukModel::where('id_produk', $id)->update([
            'nama_produk'       => $request->nama_produk,
            'id_jenisproduk'    => $request->id_jenisproduk,
            'harga_produk'      => $request->harga_produk,
            'jumlah_tersedia'   => $request->jumlah_tersedia,
            'status'            => $request->status,
        ]);

        $produks = ProdukModel::all();
        $jenisproduks = JenisProdukModel::all();
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Produk',
            'breadcrumbchild' => 'Produk',
            'loginuser' => 'User',
            'pageurl' => 'produk',
            'produks' => $produks,
            'jenisproduks' => $jenisproduks,
            'editproduks' => '',
            'flag' => '1',
        );
        return view('pages.admin.produk', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = ProdukModel::where('id_produk', $id)->delete();
        return json_encode(array('urlproduk' => 'produk'));

    }
}
