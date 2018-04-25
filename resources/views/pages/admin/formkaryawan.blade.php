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
                        $urlform = url("/karyawan/".$editkaryawans->id_karyawan);
                        $idkaryawan = $editkaryawans->id_karyawan;
                        $namakaryawan = $editkaryawans->nama_karyawan;
                        $alamat = $editkaryawans->alamat;
                        $notelp = $editkaryawans->no_telp;
                        $email = $editkaryawans->email;
                        $jabatan = $editkaryawans->jabatan;
                        $tempatlahir = $editkaryawans->tempat_lahir;
                        $tanggallahir = $editkaryawans->tanggal_lahir;
                        $jeniskelamin = $editkaryawans->jenis_kelamin;
                        $status = $editkaryawans->status;
                        $bekerjasejak = $editkaryawans->bekerja_sejak;
                    }
                    else {
                        $urlform = url("/karyawan");
                        $idkaryawan = "";
                        $namakaryawan = "";
                        $alamat = "";
                        $notelp = "";
                        $email = "";
                        $jabatan = "";
                        $tempatlahir = "";
                        $tanggallahir = "";
                        $jeniskelamin = "";
                        $status = "";
                        $bekerjasejak = "";
                    }
                ?>
                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/karyawan') }}'"><i class="icon-arrow-left8 position-left"></i> KEMBALI KE KARYAWAN</button>
                <hr>
                <form class="form-horizontal" action="<?php echo $urlform;?>" method="post" style="border: 1px; margin-left: 20px">

                    <fieldset class="content-group">
                        <!-- ID KARYAWAN -->
                        <div class="form-group form-group-material">
                            <label class="control-label">ID Karyawan</label>
                            <input type="text" class="form-control" name="id_karyawan" placeholder="ID Karyawan" value="<?php echo $idkaryawan; ?>">
                        </div>
                        <!-- NAMA KARYAWAN -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Nama Karyawan</label>
                            <input type="text" class="form-control" name="nama_karyawan" placeholder="Nama Karyawan" value="<?php echo $namakaryawan; ?>">
                        </div>
                        <!-- ALAMAT -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Alamat</label>
                            <textarea rows="5" cols="5" class="form-control" name="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                        </div>
                        <!-- NO TELP -->
                        <div class="form-group form-group-material">
                            <label class="control-label">No. Telp</label>
                            <input type="text" class="form-control" name="no_telp" placeholder="No. Telp" value="<?php echo $notelp; ?>">
                        </div>
                        <!-- EMAIL -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>">
                        </div>
                        <!-- JABATAN -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Jabatan</label>
                            <select class="form-control" name="jabatan">
                                <optgroup label="Jabatan">
                                    <option value="0" <?php if($jabatan == '0') echo 'selected=selected'; else echo '';?>>Admin Penagihan</option>
                                    <option value="1" <?php if($jabatan == '1') echo 'selected=selected'; else echo '';?>>Admin Pengiriman</option>
                                    <option value="2" <?php if($jabatan == '2') echo 'selected=selected'; else echo '';?>>Kolektor</option>
                                    <option value="3" <?php if($jabatan == '3') echo 'selected=selected'; else echo '';?>>Sales</option>
                                    <option value="4" <?php if($jabatan == '4') echo 'selected=selected'; else echo '';?>>Supervisor</option>
                                </optgroup>
                            </select>
                        </div>
                        <!-- TTL -->
                        <div class="form-group">
                            <label>Tempat, Tanggal Lahir</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat" value="<?php echo $tempatlahir; ?>">
                                </div>

                                <div class="col-md-8">
                                    <input type="text" class="form-control tanggal_lahir" name="tanggal_lahir" placeholder="(dd-mm-yyyy)" value="<?php echo $tanggallahir; ?>">
                                </div>
                            </div>
                        </div>
                        <!-- JENIS KELAMIN -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin">
                                <optgroup label="Jenis Kelamin">
                                    <option value="0" <?php if($jeniskelamin == '0') echo 'selected=selected'; else echo '';?>>Laki - laki</option>
                                    <option value="1" <?php if($jeniskelamin == '1') echo 'selected=selected'; else echo '';?>>Perempuan</option>
                                </optgroup>
                            </select>
                        </div>
                        <!-- BEKERJA SEJAK -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Bekerja Sejak</label>
                            <input type="text" class="form-control bekerja_sejak" name="bekerja_sejak" placeholder="Bekerja Sejak (dd-mm-yyyy)" value="<?php echo $bekerjasejak; ?>">
                        </div>
                        <!-- STATUS -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Status</label>
                            <select class="form-control" name="status">
                                <optgroup label="Status">
                                    <option value="0" <?php if($status == '0') echo 'selected=selected'; else echo '';?>>Aktif</option>
                                    <option value="1" <?php if($status == '1') echo 'selected=selected'; else echo '';?>>Tidak Aktif</option>
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

        $(".tanggal_lahir").datepicker({
            changeMonth: true,
            changeYear: true
        });
        $(".tanggal_lahir").datepicker("option", "dateFormat", "dd-mm-yy");
        var tgllahir = "<?php echo $tanggallahir; ?>";
        if(tgllahir != "")
            $(".tanggal_lahir").datepicker('setDate', moment(tgllahir, "DD-MM-YYYY").format("DD-MM-YYYY"));

        $(".bekerja_sejak").datepicker({
            changeMonth: true,
            changeYear: true
        });
        $(".bekerja_sejak").datepicker("option", "dateFormat", "dd-mm-yy");
        var bekerjasejak = "<?php echo $bekerjasejak; ?>";
        if(bekerjasejak != "")
            $(".bekerja_sejak").datepicker('setDate', moment(bekerjasejak, "DD-MM-YYYY").format("DD-MM-YYYY"));

        $('#tblkaryawan').DataTable({
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