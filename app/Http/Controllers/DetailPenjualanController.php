<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\DetailPenjualanModel;
use App\Models\ProdukModel;
use App\Models\PenjualanModel;

class DetailPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showdetail($id)
    {
        $detailpenjualans = DetailPenjualanModel::where('id_penjualan', $id)->get();
        $produks = ProdukModel::all();
        //dd($detailpenjualans);
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Penjualan',
            'breadcrumbchild' => 'Detail Penjualan',
            'loginuser' => 'User',
            'pageurl' => 'detailpenjualan',
            'detailpenjualans' => $detailpenjualans,
            'produks' => $produks,
            'editdetailpenjualans' => '',
            'flag' => '',
        );
        return view('pages.detailpenjualan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $detailpenjualans = DetailPenjualanModel::where('id_penjualan', $id)->get();
        $produks = ProdukModel::all();
        //dd($detailpenjualans);
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Penjualan',
            'breadcrumbchild' => 'Detail Penjualan',
            'loginuser' => 'User',
            'pageurl' => 'detailpenjualan',
            'detailpenjualans' => $detailpenjualans,
            'produks' => $produks,
            'editdetailpenjualans' => '',
            'flag' => '',
        );
        return view('pages.formdetailpenjualan', $data);
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
        DetailPenjualanModel::create([
            'id_penjualan' => $request->id_penjualan,
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual,
        ]);

        $detailtotal = DetailPenjualanModel::where("id_penjualan","=",$request->id_penjualan)->selectRaw('sum(jumlah * harga_jual) as total')->get();
        foreach ($detailtotal as $data) {
            $total = $data->total;
        }
        //dd($total);

        PenjualanModel::where('id_penjualan', $request->id_penjualan)->update([
            'total' => $total,
        ]);

        $datajumtersedia = ProdukModel::where("id_produk","=",$request->id_produk)->select('jumlah_tersedia')->get();
        foreach ($datajumtersedia as $data) {
            $jumlah_tersedia = $data->jumlah_tersedia - $request->jumlah;
        }
        //dd($jumlah_tersedia);
        ProdukModel::where('id_produk', $request->id_produk)->update([
            'jumlah_tersedia'   => $jumlah_tersedia,
        ]);

        $detailpenjualans = DetailPenjualanModel::where('id_penjualan', $request->id_penjualan)->get();
        $produks = ProdukModel::all();
        //dd($detailpenjualans);
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Penjualan',
            'breadcrumbchild' => 'Detail Penjualan',
            'loginuser' => 'User',
            'pageurl' => 'detailpenjualan',
            'detailpenjualans' => $detailpenjualans,
            'produks' => $produks,
            'editdetailpenjualans' => '',
            'flag' => '0',
        );
        return redirect('detailpenjualan/'.$request->id_penjualan.'/showdetail');
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
    public function edit($id,$iddetail)
    {
        $editdetailpenjualans = DetailPenjualanModel::where('id_detailpenjualan',$iddetail)->first();
        //dd($editpenjualans);
        if(!$editdetailpenjualans)
            abort(404);

        $detailpenjualans = DetailPenjualanModel::where('id_penjualan', $id)->get();
        $produks = ProdukModel::all();
        //dd($detailpenjualans);
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Penjualan',
            'breadcrumbchild' => 'Detail Penjualan',
            'loginuser' => 'User',
            'pageurl' => 'detailpenjualan',
            'detailpenjualans' => $detailpenjualans,
            'produks' => $produks,
            'editdetailpenjualans' => $editdetailpenjualans,
            'flag' => '',
        );
        return view('pages.formdetailpenjualan', $data);
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
        $jumsekarang = DetailPenjualanModel::where("id_detailpenjualan","=",$id)->select('jumlah')->get();
        foreach ($jumsekarang as $data) {
            $jumsekarang = $data->jumlah;
        }
        //dd($jumsekarang);
        DetailPenjualanModel::where('id_detailpenjualan', $id)->update([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'harga_jual' => $request->harga_jual,
        ]);

        $detailtotal = DetailPenjualanModel::where("id_penjualan","=",$request->id_penjualan)->selectRaw('sum(jumlah * harga_jual) as total')->get();
        foreach ($detailtotal as $data) {
            $total = $data->total;
        }
        //dd($total);

        PenjualanModel::where('id_penjualan', $request->id_penjualan)->update([
            'total' => $total,
        ]);

        $datajumtersedia = ProdukModel::where("id_produk","=",$request->id_produk)->select('jumlah_tersedia')->get();
        foreach ($datajumtersedia as $data) {
            if($jumsekarang < $request->jumlah)
                $jumlah_tersedia = $data->jumlah_tersedia - $request->jumlah + $jumsekarang;
            else if($jumsekarang > $request->jumlah)
                $jumlah_tersedia = $data->jumlah_tersedia + $request->jumlah - $jumsekarang;
            else
                $jumlah_tersedia = $data->jumlah_tersedia;
        }
        //dd($jumlah_tersedia);
        ProdukModel::where('id_produk', $request->id_produk)->update([
            'jumlah_tersedia'   => $jumlah_tersedia,
        ]);

        $detailpenjualans = DetailPenjualanModel::where('id_penjualan', $request->id_penjualan)->get();
        $produks = ProdukModel::all();
        //dd($detailpenjualans);
        $data = array(
            'title' => 'Dashboard',
            'breadcrumb' => 'Master Penjualan',
            'breadcrumbchild' => 'Detail Penjualan',
            'loginuser' => 'User',
            'pageurl' => 'detailpenjualan',
            'detailpenjualans' => $detailpenjualans,
            'produks' => $produks,
            'editdetailpenjualans' => '',
            'flag' => '1',
        );
        return redirect('detailpenjualan/'.$request->id_penjualan.'/showdetail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idpenjualan, $idproduk, $jumlah)
    {
        //dd($idpenjualan);
        $jumsekarang = DetailPenjualanModel::where("id_detailpenjualan","=",$id)->select('jumlah')->get();
        foreach ($jumsekarang as $data) {
            $jumsekarang = $data->jumlah;
        }
        //dd($jumsekarang);

        //HAPUS DATA
        $detailpenjualan = DetailPenjualanModel::where('id_detailpenjualan', $id)->delete();

        $detailtotal = DetailPenjualanModel::where("id_penjualan","=",$idpenjualan)->selectRaw('sum(jumlah * harga_jual) as total')->get();
        foreach ($detailtotal as $data) {
            $total = $data->total;
        }
        //dd($total);

        PenjualanModel::where('id_penjualan', $idpenjualan)->update([
            'total' => $total,
        ]);

        $datajumtersedia = ProdukModel::where("id_produk","=",$idproduk)->select('jumlah_tersedia')->get();
        foreach ($datajumtersedia as $data) {
            if($jumsekarang < $jumlah)
                $jumlah_tersedia = $data->jumlah_tersedia - $jumlah + $jumsekarang;
            else if($jumsekarang > $jumlah)
                $jumlah_tersedia = $data->jumlah_tersedia + $jumlah - $jumsekarang;
            else
                $jumlah_tersedia = $data->jumlah_tersedia;
        }
        //dd($jumlah_tersedia);
        ProdukModel::where('id_produk', $idproduk)->update([
            'jumlah_tersedia'   => $jumlah_tersedia,
        ]);

        return json_encode(array('urldetailpenjualan' => 'detailpenjualan'));
    }
}
