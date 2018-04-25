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
                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/penjualan/create') }}'"><i class="icon-plus3 position-left"></i> TAMBAH PENJUALAN</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover tblPenjualan" width="100%" id="tblPenjualan">
                    <thead>
                        <tr>
                            <th width="420">ID Penjualan</th>
                            <th width="420">Nama Pelanggan</th>
                            <th width="420">Nama Karyawan</th>
                            <th width="420">Tanggal</th>
                            <th width="420">Total</th>
                            <th width="420">Status</th>
                            <th class="text-center" width="420">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($penjualans as $penjualan)
                        <tr>
                            <td>{{ $penjualan->id_penjualan }}</td>
                            <td>
                                <?php
                                foreach ($pelanggans as $pelanggan) {
                                    if ($pelanggan->id_pelanggan == $penjualan->id_pelanggan) {
                                        echo $pelanggan->nama_toko;
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                foreach ($karyawans as $karyawan) {
                                    if ($karyawan->id_karyawan == $penjualan->id_karyawan) {
                                        echo $karyawan->nama_karyawan;
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td><?php echo date('d-m-Y', strtotime($penjualan->tanggal_penjualan)); ?></td>
                            <td>{{ $penjualan->total }}</td>
                            <td>
                                @if($penjualan->status == "0")
                                <span class="label label-info">Belum Lunas</span>
                                @elseif($penjualan->status == "1")
                                <span class="label label-success">Lunas</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-xs" onclick="showdetail('{{ $penjualan->id_penjualan }}')"><i class="icon-clipboard3 position-left"></i> Show Detail</button>
                                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/penjualan/'.$penjualan->id_penjualan.'/formedit') }}'"><i class="icon-pencil3 position-left"></i> Edit</button>
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

        $('#tblPenjualan').DataTable({
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

    function showdetail(id) {
        window.location.href = "{{ url('detailpenjualan') }}" + "/" + id + "/showdetail";
    }
</script>
@endsection