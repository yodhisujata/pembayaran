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
            <div class="col-md-12">
                <?php
                    $idpenjualan = Request::segment(2);
                ?>
                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/detailpenjualan/'.$idpenjualan.'/create') }}'"><i class="icon-plus3 position-left"></i> TAMBAH DETAIL PENJUALAN</button>
                <button type="button" class="btn btn-info btn-xs" onclick="kembalikepenjualan()"><i class="icon-arrow-left8 position-left"></i> Kembali Ke Penjualan</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover tblDetailPenjualan" width="100%" id="tblDetailPenjualan">
                    <thead>
                        <tr>
                            <th width="420">ID Detail</th>
                            <th width="420">Nama Produk</th>
                            <th width="420">Jumlah</th>
                            <th width="420">Harga Jual</th>
                            <th class="text-center" width="420">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($detailpenjualans as $detailpenjualan)
                        <tr>
                            <td>{{ $detailpenjualan->id_detailpenjualan }}</td>
                            <td>
                                <?php
                                foreach ($produks as $produk) {
                                    if ($produk->id_produk == $detailpenjualan->id_produk) {
                                        echo $produk->nama_produk;
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td>{{ $detailpenjualan->jumlah }}</td>
                            <td>{{ $detailpenjualan->harga_jual }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/detailpenjualan/'.$idpenjualan.'/'.$detailpenjualan->id_detailpenjualan.'/formedit') }}'"><i class="icon-pencil3 position-left"></i> Edit</button>
                                <button type="button" class="btn btn-danger btn-xs" onclick="deleteconfirm('{{ $detailpenjualan->id_detailpenjualan }}','{{$detailpenjualan->id_penjualan}}','{{$detailpenjualan->id_produk}}','{{$detailpenjualan->jumlah}}','{{ csrf_token() }}')"><i class="icon-eraser position-left"></i> Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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

    $('#tblDetailPenjualan').DataTable({
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

    function deleteconfirm(id, idpenjualan, idproduk, jumlah, token) {
        noty({
            width: 200,
            text: 'Hapus Data Detail Penjualan ini?',
            type: 'confirm',
            layout: 'center',
            buttons: [
                {
                    addClass: 'btn btn-primary btn-xs',
                    text: 'Ok',
                    onClick: function ($noty) { //this = button element, $noty = $noty element
                        $noty.close();
                        $.ajax({
                            url: "{{ url('detailpenjualan') }}" + "/" + id + "/" + idpenjualan + "/" + idproduk + "/" + jumlah,
                            type: 'DELETE',
                            dataType: "JSON",
                            async: false,
                            data: {
                                "id": id,
                                "idpenjualan": idpenjualan,
                                "idproduk": idproduk,
                                "jumlah": jumlah,
                                "_method": 'DELETE',
                                "_token": token,
                            },
                            success: function (data) {

                                noty({
                                    force: true,
                                    text: 'Data Detail Penjualan Berhasil Dihapus.',
                                    type: 'success',
                                    dismissQueue: true,
                                    timeout: 2000,
                                    layout: 'bottom'
                                });
                                window.location.href = "{{ url('') }}" + "/" + data.urldetailpenjualan + "/" + idpenjualan + "/showdetail";
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

</script>
@endsection