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
                        $urlform = url("/produk/".$editproduks->id_produk);
                        $idproduk = $editproduks->id_produk;
                        $namaproduk = $editproduks->nama_produk;
                        $idjenisproduk = $editproduks->id_jenisproduk;
                        $hargaproduk = $editproduks->harga_produk;
                        $jumlahtersedia = $editproduks->jumlah_tersedia;
                        $status = $editproduks->status;
                    }
                    else {
                        $urlform = url("/produk");
                        $idproduk = "";
                        $namaproduk = "";
                        $idjenisproduk = "";
                        $hargaproduk = "";
                        $jumlahtersedia = "";
                        $status = "";
                    }
                ?>
                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/produk') }}'"><i class="icon-arrow-left8 position-left"></i> KEMBALI KE PRODUK</button>
                <hr>
                <form class="form-horizontal" action="<?php echo $urlform;?>" method="post" style="border: 1px; margin-left: 20px">

                    <fieldset class="content-group">
                        <!-- ID PRODUK -->
                        <div class="form-group form-group-material">
                            <label class="control-label">ID Produk</label>
                            <input type="text" class="form-control" name="id_produk" placeholder="ID Produk" readonly="readonly" value="<?php echo $idproduk; ?>">
                        </div>
                        <!-- NAMA PRODUK -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk" value="<?php echo $namaproduk; ?>">
                        </div>
                        <!-- JENIS PRODUK -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Jenis Produk</label>
                            <select class="form-control" name="id_jenisproduk">
                                <optgroup label="Jenis Produk">
                                    @foreach($jenisproduks as $jenisproduk)
                                    <option value="{{ $jenisproduk->id_jenisproduk}}" <?php if($idjenisproduk == $jenisproduk->id_jenisproduk) echo 'selected=selected'; else echo '';?>>{{$jenisproduk->nama_jenis}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <!-- HARGA PRODUK -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Harga Produk</label>
                            <div class="input-group">
                            <span class="input-group-addon">RP. </span>
                            <input type="text" class="form-control" name="harga_produk" placeholder="Harga Produk" value="<?php echo $hargaproduk; ?>">
                            </div>
                        </div>
                        <!-- JUMLAH TERSEDIA -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Jumlah Tersedia</label>
                            <input type="text" class="form-control" name="jumlah_tersedia" placeholder="Jumlah Tersedia" value="<?php echo $jumlahtersedia; ?>">
                        </div>
                        <!-- STATUS PRODUK -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Status Produk</label>
                            <select class="form-control" name="status">
                                <optgroup label="Status Produk">
                                    <option value="0" <?php if($status == "0") echo 'selected=selected'; else echo '';?>>Aktif</option>
                                    <option value="1" <?php if($status == "1") echo 'selected=selected'; else echo '';?>>Tidak Aktif</option>
                                </optgroup>
                            </select>
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
        $('#tblProduk').DataTable({
            scrollY: "300",
            scrollX: true,
            scrollCollapse: false,
            paging: true,
            fixedColumns: {
                leftColumns: 0,
                rightColumns: 1
            }
        });

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
</script>
@endsection