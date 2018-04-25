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
                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/pelanggan/create') }}'"><i class="icon-plus3 position-left"></i> TAMBAH PELANGGAN</button>
                <table class="table table-striped table-hover" width="100%" id="tblpelanggan">
                    <thead>
                        <tr>
                            <th width="420">ID Pelanggan</th>
                            <th width="420">Nama Toko</th>
                            <th width="420">Nama Pemilik</th>
                            <th width="420">Alamat</th>
                            <th width="420">Email</th>
                            <th width="420">No Telp / HP</th>
                            <th width="420">Status</th>
                            <th class="text-center" width="420">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pelanggans as $pelanggan)
                        <tr>
                            <td>{{ $pelanggan->id_pelanggan }}</td>
                            <td>{{ $pelanggan->nama_toko }}</td>
                            <td>{{ $pelanggan->nama_pemilik }}</td>
                            <td>{{ $pelanggan->alamat }}</td>
                            <td>{{ $pelanggan->email }}</td>
                            <td>{{ $pelanggan->no_telp }}</td>
                            <td>
                                <?php
                                    if($pelanggan->status == "0")
                                        echo '<span class="label bg-success-400">Aktif</span>';
                                    else if($pelanggan->status == "1")
                                        echo '<span class="label bg-danger-400">Tidak Aktif</span>';
                                ?>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/pelanggan/'.$pelanggan->id_pelanggan.'/formedit') }}'"><i class="icon-pencil3 position-left"></i> Edit</button>
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
        $('#tblpelanggan').DataTable({
            scrollY: "300",
            scrollX: true,
            scrollCollapse: false,
            paging: true,
            fixedColumns: {
                leftColumns: 0,
                rightColumns: 2
            }
        });
        function editdata(id) {
            console.log(id);
        }

        var flag = "<?php echo $flag; ?>";
        if (flag != "") {
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