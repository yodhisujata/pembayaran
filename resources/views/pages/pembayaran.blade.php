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
                <table class="table table-striped table-hover tblPenjualan" width="100%" id="tblPenjualan">
                    <thead>
                        <tr>
                            <th width="420">ID Penjualan</th>
                            <th width="420">Nama Pelanggan</th>
                            <th width="420">Tanggal</th>
                            <th width="420">Total</th>
                            <th width="420">Dibayar</th>
                            <th width="420">Sisa Hutang</th>
                            <th class="text-center" width="420">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pembayarans as $pembayaran)
                        <tr>
                            <td>{{ $pembayaran->id_penjualan }}</td>
                            <td>
                                <?php
                                $namatoko = "";
                                foreach ($pelanggans as $pelanggan) {
                                    if ($pelanggan->id_pelanggan == $pembayaran->id_pelanggan) {
                                        echo $pelanggan->nama_toko;
                                        $namatoko = $pelanggan->nama_toko;
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td><?php echo date('d-m-Y', strtotime($pembayaran->tanggal_penjualan)); ?></td>
                            <td>{{ $pembayaran->total }}</td>
                            <td>0</td>
                            <td>
                                <?php
                                $sisahutang = 0;
                                foreach ($totalbayars as $totalbayar) {
                                    if ($totalbayar->id_penjualan == $pembayaran->id_penjualan) {
                                        if($totalbayar->totalbayar == null)
                                            $totalbayar->totalbayar = 0;

                                        $sisahutang = $pembayaran->total - $totalbayar->totalbayar;
                                        if($sisahutang < 0)
                                            $sisahutang = 0;
                                        echo $sisahutang;
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                @if($pembayaran->status == "0")
                                    <button type="button" class="btn btn-info btn-xs" onclick="showmodalpembayaran('{{ $pembayaran->id_penjualan }}','<?php echo $namatoko; ?>', '<?php echo $sisahutang; ?>')"><i class="icon-pencil3 position-left"></i> Pembayaran</button>
                                @else
                                    <span class="label label-success">Lunas</span>
                                @endif
                                <button type="button" class="btn btn-default btn-xs" onclick="showmodaldetail('{{ $pembayaran->id_penjualan }}','<?php echo $namatoko; ?>', '<?php echo $sisahutang; ?>')"><i class="icon-pencil3 position-left"></i> Show</button>
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

<!-- pembayaran modal -->
<div id="modal_pembayaran" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Pembayaran</h6>
            </div>
            <?php
                $urlform = "";
                $urlform = url("/pembayaran");
                $idpenjualan = "";
                $idkaryawan = "";
                $jumlah_bayar = "";
            ?>
            <form class="form-horizontal" action="<?php echo $urlform;?>" method="post" style="border: 1px; margin-left: 20px">

                <div class="modal-body">
                    <fieldset class="content-group">
                        <div class="form-group">
                            <label id="penjelasan" class="control-label">AAAAA</label>
                        </div>
                        <!-- ID PENJUALAN -->
                        <input type="hidden" class="form-control" id="id_penjualan" name="id_penjualan" placeholder="ID Penjualan" readonly="readonly" value="<?php echo $idpenjualan; ?>">
                        <!-- ID KARYAWAN -->
                        <input type="hidden" class="form-control" id="id_karyawan" name="id_karyawan" placeholder="ID Karyawan" readonly="readonly" value="<?php echo $idkaryawan; ?>">
                        <!-- SISA HUTANG -->
                        <input type="hidden" class="form-control" id="sisa_hutang" name="sisa_hutang" placeholder="ID Karyawan" readonly="readonly" value="<?php echo $idkaryawan; ?>">
                        <!-- TOTAL HARGA -->
                        <div class="form-group form-group-material">
                            <label class="control-label">Jumlah Bayar</label>
                            <div class="input-group">
                                <span class="input-group-addon">RP. </span>
                                <input type="text" class="form-control" name="jumlah_bayar" placeholder="Jumlah Bayar" value="<?php if($jumlah_bayar == ""){ echo "0";} else { echo $jumlah_bayar; }?>">
                            </div>
                        </div>

                        {{ csrf_field() }}

                    </fieldset>

                </div>

                <div class="modal-footer">
                    <!-- BUTTON -->
                    <button type="submit" class="btn bg-teal-400 btn-labeled"><b><i class="icon-floppy-disk"></i></b> Bayar</button>
                    <!--button type="reset" class="btn btn-primary btn-labeled"><b><i class="icon-reset"></i></b> Reset</button-->
                    <!--button type="button" class="btn btn-danger btn-labeled" data-dismiss="modal"><b><i class="icon-exit"></i></b>Close</button-->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /pembayaran modal -->

<!-- pembayaran modal -->
<div id="modal_detailpembayaran" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Detail Pembayaran</h6>
            </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover tblPembayaran" width="100%" id="tblPembayaran">
                        <thead>
                        <tr>
                            <th width="420">ID Pembayaran</th>
                            <th width="420">Tanggal</th>
                            <th width="420">Jumlah Bayar</th>
                        </tr>
                        </thead>
                        <tbody id="bodydetail">
                        @foreach($detailpembayarans as $detail)
                        <tr>
                            <td>{{ $detail->id_pembayaran }}</td>
                            <td><?php echo date('d-m-Y', strtotime($detail->tanggal_pembayaran)); ?></td>
                            <td>{{ $detail->jumlah_bayar }}</td>
                        </tr>
                        @endforeach;
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-labeled" data-dismiss="modal"><b><i class="icon-exit"></i></b>Close</button>
                </div>
        </div>
    </div>
</div>
<!-- /pembayaran modal -->

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

    function showmodalpembayaran(idpenjualan, namatoko, sisahutang) {
        document.getElementById("penjelasan").innerHTML  = "<h6>Pembayaran untuk ID " + idpenjualan + " Atas Nama " + namatoko.toUpperCase() + "<br> Sisa Hutang = " + sisahutang + "</h6>";
        document.getElementById("id_penjualan").value = idpenjualan;
        document.getElementById("id_karyawan").value = "101";
        document.getElementById("sisa_hutang").value = sisahutang;
        $("#modal_pembayaran").modal("show");
    }

    function showmodaldetail(idpenjualan, namatoko, sisahutang) {
        var detailpembayaran = JSON.parse('<?php echo $detailpembayarans; ?>');
        console.log(detailpembayaran);
        var detail = "";
        $.each(detailpembayaran, function (key, value) {
            if(detailpembayaran[key].id_penjualan == idpenjualan) {
                detail = detail +
                    "<tr>" +
                    "<td>" + detailpembayaran[key].id_pembayaran + "</td>" +
                    "<td>" + moment(detailpembayaran[key].tanggal_pembayaran, "YYYY-MM-DD").format("DD-MM-YYYY") + "</td>" +
                    "<td>" + detailpembayaran[key].jumlah_bayar + "</td>" +
                    "</tr>";
            }
        });
        console.log(detail);

        document.getElementById("bodydetail").innerHTML  = detail;
        $("#modal_detailpembayaran").modal("show");
    }

    function showdetail(id) {
        window.location.href = "{{ url('detailpenjualan') }}" + "/" + id + "/showdetail";
    }
</script>
@endsection