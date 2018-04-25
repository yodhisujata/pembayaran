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
                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/produk/create') }}'"><i class="icon-plus3 position-left"></i> TAMBAH PRODUK</button>
                <table class="table table-striped table-hover" width="100%" id="tblProduk">
                    <thead>
                        <tr>
                            <th width="420">ID Produk</th>
                            <th width="420">Nama Produk</th>
                            <th width="420">Jenis Produk</th>
                            <th width="420">Harga Produk</th>
                            <th width="420">Jumlah Tersedia</th>
                            <th width="420">Last Update</th>
                            <th width="420">Status</th>
                            <th class="text-center" width="420">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($produks as $produk)
                        <tr>
                            <td>{{ $produk->id_produk }}</td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>
                                <?php
                                foreach ($jenisproduks as $jenisproduk) {
                                    if ($jenisproduk->id_jenisproduk == $produk->id_jenisproduk) {
                                        echo $jenisproduk->nama_jenis;
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td>{{ $produk->harga_produk }}</td>
                            <td>{{ $produk->jumlah_tersedia }}</td>
                            <td> <?php echo date('d-m-Y', strtotime($produk->updated_at)); ?> </td>
                            <td>
                                @if($produk->status == "0")
                                <span class="label label-success">Aktif</span>
                                @else
                                <span class="label label-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/produk/'.$produk->id_produk.'/formedit') }}'"><i class="icon-pencil3 position-left"></i> Edit</button>
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
        $('#tblProduk').DataTable({
            scrollY: "300",
            scrollX: true,
            scrollCollapse: false,
            paging: true,
            fixedColumns: {
                leftColumns: 0,
                rightColumns: 2
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