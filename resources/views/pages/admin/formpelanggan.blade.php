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
                        $urlform = url("/pelanggan/".$editpelanggans->id_pelanggan);
                        $idpelanggan = $editpelanggans->id_pelanggan;
                        $namatoko = $editpelanggans->nama_toko;
                        $namapemilik = $editpelanggans->nama_pemilik;
                        $alamat = $editpelanggans->alamat;
                        $email = $editpelanggans->email;
                        $notelp = $editpelanggans->no_telp;
                        $status = $editpelanggans->status;
                    }
                    else {
                        $urlform = url("/pelanggan");
                        $idpelanggan = "";
                        $namatoko = "";
                        $namapemilik = "";
                        $alamat = "";
                        $email = "";
                        $notelp = "";
                        $status = "";
                    }
                ?>
                <button type="button" class="btn btn-info btn-xs" onclick="window.location='{{ url('/pelanggan') }}'"><i class="icon-arrow-left8 position-left"></i> KEMBALI KE PELANGGAN</button>
                <hr>
                <form class="form-horizontal" action="<?php echo $urlform;?>" method="post" style="border: 1px; margin-left: 20px">

                    <fieldset class="content-group">
                        <!-- ID PELANGGAN -->
                        <div class="form-group form-group-material">
                            <label class="control-label">ID pelanggan</label>
                            <input type="text" class="form-control" name="id_pelanggan" placeholder="ID Pelanggan" readonly="readonly" value="<?php echo $idpelanggan; ?>">
                        </div>
                        <!-- NAMA TOKO -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Nama Toko</label>
                            <input type="text" class="form-control" name="nama_toko" placeholder="Nama Toko" value="<?php echo $namatoko; ?>">
                        </div>
                        <!-- NAMA PEMILIK -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Nama Pemilik</label>
                            <input type="text" class="form-control" name="nama_pemilik" placeholder="Nama Pemilik" value="<?php echo $namapemilik; ?>">
                        </div>
                        <!-- ALAMAT -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Alamat</label>
                            <textarea rows="5" cols="5" class="form-control" name="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                        </div>
                        <!-- Email -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>">
                        </div>
                        <!-- Email -->
                        <div class="form-group form-group-material">
                            <label class="control-label">No.Telp/HP</label>
                            <input type="text" class="form-control" name="no_telp" placeholder="No Telp / HP" value="<?php echo $notelp; ?>">
                        </div>
                        <!-- STATUS -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Status</label>
                            <select class="form-control" name="status">
                                <optgroup label="Status Pelanggan">
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
        $('#tblpelanggan').DataTable({
            scrollY: "300",
            scrollX: true,
            scrollCollapse: false,
            paging: true,
            fixedColumns: {
                leftColumns: 0,
                rightColumns: 1
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

    function deleteconfirm(id, nama, token) {
        noty({
            width: 200,
            text: 'Hapus Data ' + nama,
            type: 'confirm',
            layout: 'center',
            buttons: [
                {
                    addClass: 'btn btn-primary btn-xs',
                    text: 'Ok',
                    onClick: function ($noty) { //this = button element, $noty = $noty element
                        $noty.close();
                        $.ajax({
                            url: "{{ url('pelanggan') }}" + "/" + id,
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
                                    text: 'Data pelanggan Berhasil Dihapus.',
                                    type: 'success',
                                    dismissQueue: true,
                                    timeout: 2000,
                                    layout: 'bottom'
                                });
                                window.location.href = "{{ url('') }}" + "/" + data.urlpelanggan;
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
                            text: 'Batal Hapus Data pelanggan',
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