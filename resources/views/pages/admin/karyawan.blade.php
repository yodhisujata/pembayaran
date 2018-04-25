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
                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/karyawan/create') }}'"><i class="icon-plus3 position-left"></i> TAMBAH KARYAWAN</button>
                <table class="table table-striped table-hover" width="100%" id="tblkaryawan">
                    <thead>
                        <tr>
                            <th width="420">ID Karyawan</th>
                            <th width="420">Nama Karyawan</th>
                            <th width="420">No Telp</th>
                            <th width="420">Email</th>
                            <th width="420">Jabatan</th>
                            <th width="420">Tempat, Tanggal Lahir</th>
                            <th width="420">Jenis Kelamin</th>
                            <th width="420">Alamat</th>
                            <th width="420">Bekerja Sejak</th>
                            <th width="420">Status</th>
                            <th class="text-center" width="420">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($karyawans as $karyawan)
                        <tr>
                            <td>{{ $karyawan->id_karyawan }}</td>
                            <td>{{ $karyawan->nama_karyawan }}</td>
                            <td>{{ $karyawan->no_telp }}</td>
                            <td>{{ $karyawan->email }}</td>
                            <td>
                                <?php
                                    if($karyawan->jabatan == "0")
                                        echo "Admin Penagihan";
                                    elseif($karyawan->jabatan == "1")
                                        echo "Admin Pengiriman";
                                    elseif($karyawan->jabatan == "2")
                                        echo "Kolektor";
                                    elseif($karyawan->jabatan == "3")
                                        echo "Sales";
                                    elseif($karyawan->jabatan == "4")
                                        echo "Supervisor";
                                ?>
                            </td>
                            <td>{{ $karyawan->tempat_lahir }}, <?php echo date('d-m-Y', strtotime($karyawan->tanggal_lahir)); ?></td>
                            <td>
                                <?php
                                    if($karyawan->jenis_kelamin == "0")
                                        echo "Laki-laki";
                                    elseif($karyawan->jenis_kelamin == "1")
                                        echo "Perempuan";
                                ?>
                            </td>
                            <td>{{ $karyawan->alamat }}</td>
                            <td><?php echo date('d-m-Y', strtotime($karyawan->bekerja_sejak)); ?></td>
                            <td>
                                @if($karyawan->status == "0")
                                <span class="label label-success">Aktif</span>
                                @else
                                <span class="label label-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/karyawan/'.$karyawan->id_karyawan.'/formedit') }}'"><i class="icon-pencil3 position-left"></i> Edit</button>
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


        $('#tblkaryawan').DataTable({
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