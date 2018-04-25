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
                if(Request::segment(4) == "formedit") {
                    $urlform = url("/detailpenjualan/".$editdetailpenjualans->id_detailpenjualan);
                    $iddetailpenjualan = $editdetailpenjualans->id_detailpenjualan;
                    $idpenjualan = $editdetailpenjualans->id_penjualan;
                    $idproduk = $editdetailpenjualans->id_produk;
                    $jumlah = $editdetailpenjualans->jumlah;
                    $hargajual = $editdetailpenjualans->harga_jual;
                }
                else {
                    $urlform = url("/detailpenjualan");
                    $iddetailpenjualan = "";
                    $idpenjualan = Request::segment(2);
                    $idproduk = "";
                    $jumlah = "";
                    $hargajual = "";
                }
                ?>
                <form class="form-horizontal" action="<?php echo $urlform;?>" method="post" style="border: 1px; margin-left: 20px">

                    <fieldset class="content-group">
                        <!-- ID DETAIL PENJUALAN -->
                        <div class="form-group form-group-material">
                            <label class="control-label">ID Detail</label>
                            <input type="text" class="form-control" name="id_detailpenjualan" placeholder="ID Detail" readonly="readonly" value="<?php echo $iddetailpenjualan; ?>">
                        </div>

                        <!-- ID PENJUALAN -->
                        <input type="hidden" class="form-control" id="id_penjualan" name="id_penjualan" placeholder="ID Penjualan" readonly="readonly" value="<?php echo $idpenjualan; ?>">

                        <!-- ID PRODUK -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Jenis Produk</label>
                            <select class="form-control" id="id_produk" name="id_produk">
                                <optgroup label="Jenis Produk">
                                    @foreach($produks as $produk)
                                    <option value="{{ $produk->id_produk}}" <?php if($idproduk == $produk->id_produk) echo 'selected=selected'; else echo '';?>>{{$produk->nama_produk}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <!-- JUMLAH -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>">
                        </div>
                        <!-- HARGA JUAL -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Harga Jual</label>
                            <div class="input-group">
                                <span class="input-group-addon">RP. </span>
                                <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Harga Jual" value="<?php echo $hargajual; ?>" readonly>
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <button type="submit" class="btn bg-teal-400 btn-labeled"><b><i class="icon-floppy-disk"></i></b> Save</button>
                        <button type="reset" class="btn btn-primary btn-labeled"><b><i class="icon-reset"></i></b> Reset</button>

                        {{ csrf_field() }}
                        <?php
                        if(Request::segment(4) == "formedit") {
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

<!-- new penjualan form modal -->
<div id="modal_newdetailpenjualan" class="modal fade" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="dismissmodal()">&times;</button>
                <h5 class="modal-title">Data Penjualan</h5>
            </div>

            <div class="modal-body">


            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- /new penjualan form modal -->

@endsection

@section('jsscript')
<script>
    $(document).ready(function() {



        /*$('.tblDetailPenjualan').DataTable({
            scrollY: "300",
            scrollX: true,
            scrollCollapse: false,
            paging: true,
            fixedColumns: {
                leftColumns: 0,
                rightColumns: 1
            }
        });*/

        function editdata(id) {
            console.log(id);
        }

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

    var idproduk = document.getElementById('id_produk');
    if (idproduk) {
        idproduk.onchange = function() {
            var produks = <?php echo $produks; ?>;
            var hargajual = "";
            for (var key in produks) {
                var idperproduk = produks[key].id_produk;
                if(idperproduk == idproduk.value)
                {
                    hargajual = produks[key].harga_produk;
                    continue;
                }
            }

            var targetInput = document.getElementById('harga_jual');
            if (targetInput) {
                targetInput.value = hargajual;
            }
        }

    }

    $('#tblPenjualan').DataTable({
        scrollY: "300",
        scrollX: true,
        scrollCollapse: false,
        paging: true,
        fixedColumns: {
            leftColumns: 0,
            rightColumns: 1
        }
    });

    function kembalikepenjualan() {
        window.location.href = "{{ url('penjualan') }}";
    }

    function deleteconfirm(id, nama, token) {
        noty({
            width: 200,
            text: 'Hapus Data Penjualan ini?',
            type: 'confirm',
            layout: 'center',
            buttons: [
                {
                    addClass: 'btn btn-primary btn-xs',
                    text: 'Ok',
                    onClick: function ($noty) { //this = button element, $noty = $noty element
                        $noty.close();
                        $.ajax({
                            url: "{{ url('penjualan') }}" + "/" + id,
                            type: 'DELETE',
                            dataType: "JSON",
                            async: false,
                            data: {
                                "id": id,
                                "_method": 'DELETE',
                                "_token": token,
                            },
                            success: function (data) {

                                noty({
                                    force: true,
                                    text: 'Data Penjualan Berhasil Dihapus.',
                                    type: 'success',
                                    dismissQueue: true,
                                    timeout: 2000,
                                    layout: 'bottom'
                                });
                                window.location.href = "{{ url('') }}" + "/" + data.urlpenjualan;
                            },
                            error: function (data) {
                                console.log(data.responseText);
                            }
                        });
                    }
                },
                {
                    addClass: 'btn btn-danger btn-xs',
                    text: 'Cancel',
                    onClick: function ($noty) {
                        $noty.close();
                        noty({
                            force: true,
                            text: 'Batal Hapus Data Penjualan',
                            type: 'error',
                            dismissQueue: true,
                            timeout: 2000,
                            layout: 'bottom'
                        });
                    }
                }
            ]
        });
    };

    function dismissmodal() {
        var idpenjualan = document.getElementById("id_penjualan");
        window.location.href = "{{ url('/detailpenjualan') }}" + "/" + idpenjualan.value + "/showdetail";
    }
</script>
@endsection