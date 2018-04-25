@extends('layouts.masterpage')

@section('title')
{{ $title }}
@endsection

@section('loginuser')
{{ $loginuser }}
@endsection

@section('pageurl')
{{ url('/'.$pageurl) }}
@endsection

@section('breadcrumb')
{{ $breadcrumb }}
@endsection

@section('breadcrumbchild')
{{ $breadcrumbchild }}
@endsection

@section('loginuser')
{{ $loginuser }}
@endsection

@section('content')
<style type="text/css">
    .panel-body {
        position: relative;
        min-height: 500px;
    }
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
    }
</style>
<!-- Simple panel -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ $breadcrumbchild }}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <?php
                    $urlform = "";
                    if(Request::segment(3) == "formedit") {
                        $urlform = url("/penjualan/".$editpenjualans->id_penjualan);
                        $idpenjualan = $editpenjualans->id_penjualan;
                        $idpelanggan = $editpenjualans->id_pelanggan;
                        $idkaryawan = $editpenjualans->id_karyawan;
                        $tanggalpenjualan = date("d-m-Y", strtotime($editpenjualans->tanggal_penjualan));
                        $status = $editpenjualans->status;
                        $total = $editpenjualans->total;
                    }
                    else {
                        $urlform = url("/penjualan");
                        $idpenjualan = "";
                        $idpelanggan = "";
                        $idkaryawan = "";
                        $tanggalpenjualan = "";
                        $status = "";
                        $total = "";
                    }
                ?>
                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/penjualan') }}'"><i class="icon-arrow-left8 position-left"></i> KEMBALI KE PRODUK</button>
                <hr>
                <form class="form-horizontal" action="<?php echo $urlform;?>" method="post" style="border: 1px; margin-left: 20px">

                    <fieldset class="content-group">
                        <!-- ID PENJUALAN -->
                        <div class="form-group form-group-material">
                            <label class="control-label">ID Penjualan</label>
                            <input type="text" class="form-control" name="id_penjualan" placeholder="ID Penjualan" readonly="readonly" value="<?php echo $idpenjualan; ?>">
                        </div>
                        <!-- NAMA PELANGGAN -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Pelanggan</label>
                            <select class="form-control" name="id_pelanggan">
                                <optgroup label="Pelanggan">
                                    @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id_pelanggan}}" <?php if($idpelanggan == $pelanggan->id_pelanggan) echo 'selected=selected'; else echo '';?>>{{$pelanggan->nama_toko}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <!-- NAMA KARYAWAN -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Karyawan</label>
                            <select class="form-control" name="id_karyawan">
                                <optgroup label="Karyawan">
                                    @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id_karyawan}}" <?php if($idkaryawan == $karyawan->id_karyawan) echo 'selected=selected'; else echo '';?>>{{$karyawan->nama_karyawan}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <!-- TANGGAL PENJUALAN -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Tanggal Penjualan</label>
                            <input type="text" class="form-control tanggal_penjualan" name="tanggal_penjualan" placeholder="Tanggal Penjualan (dd-mm-yyyy)" value="<?php echo $tanggalpenjualan; ?>">
                        </div>
                        <!-- TOTAL HARGA -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Total Harga</label>
                            <div class="input-group">
                                <span class="input-group-addon">RP. </span>
                                <input type="text" class="form-control" name="total" placeholder="Total Harga" value="<?php if($total == ""){ echo "0";} else { echo $total; }?>" readonly>
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <button type="submit" class="btn bg-teal-400 btn-labeled"><b><i class="icon-floppy-disk"></i></b> Save</button>
                        <button type="reset" class="btn btn-primary btn-labeled"><b><i class="icon-reset"></i></b> Reset</button>

                        {{ csrf_field() }}
                        <?php
                        if(Request::segment(3) == "formedit") {
                            ?>
                            <input type="hidden" name="_method" value="PUT">
                            <?php
                        }
                        ?>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /simple panel -->
@endsection

@section('jsscript')
<script>
    $(document).ready(function() {

        var showedit = "<?php echo Request::segment(3) ?>";
        console.log(showedit);
        if(showedit == "formedit")
           $("#modal_newpenjualan").modal("show");

        var flag = "<?php echo $flag; ?>";
        console.log(flag);
        if(flag != "") {
            if (flag == "0") {
                noty({
                    force: true,
                    text: 'Data Berhasil Disimpan',
                    type: 'success',
                    layout: 'bottom',
                    dismissQueue: true,
                    timeout: 2000,
                });
            } else if (flag == "1") {
                noty({
                    force: true,
                    text: 'Data Berhasil Diedit',
                    type: 'success',
                    layout: 'bottom',
                    dismissQueue: true,
                    timeout: 2000,
                });
            } else if (flag == "2") {
                noty({
                    force: true,
                    text: 'Data Berhasil Dihapus',
                    type: 'success',
                    layout: 'bottom',
                    dismissQueue: true,
                    timeout: 2000,
                });
            }
        }



    });

    $(".tanggal_penjualan").datepicker({
        changeMonth: true,
        changeYear: true
    });
    $(".tanggal_penjualan").datepicker("option", "dateFormat", "dd-mm-yy");
    var tglpenjualan = "<?php echo $tanggalpenjualan; ?>";
    if(tglpenjualan != "")
        $(".tanggal_penjualan").datepicker('setDate', moment(tglpenjualan, "DD-MM-YYYY").format("DD-MM-YYYY"));

    function showdetail(id, token) {
        window.location.href = "{{ url('detailpenjualan') }}" + "/" + id + "/showdetail";
    }
</script>
@endsection