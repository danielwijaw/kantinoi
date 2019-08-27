<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Transaksi Penjualan #</h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
            <div class="table-responsive">
                <table width="100%">
                    <tr>
                        <td width="47.5%" valign="top">
                            <table width="100%" class="table">
                                <tr>
                                    <td width="50%">Tanggal Penjualan</td>
                                    <td width="5%">:</td>
                                    <td width="45%"><input type="text" class="form-control" id="tanggalnow" readonly="readonly"></td>
                                </tr>
                                <tr>
                                    <td>Pelanggan</td>
                                    <td>:</td>
                                    <td><select class="js-data-pelanggan-ajax form-control" width="100%" name="pelanggan_kasir" id="pelanggan_kasir"></select></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                            </table>
                        </td>
                        <td width="2.5%">&nbsp;</td>
                        <td width="47.5%">
                            <table width="100%" class="table">
                                <tr>
                                    <td width="50%">Kode Barang / Barcode</td>
                                    <td width="5%">:</td>
                                    <td width="45%"><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align:right">
                                        <button class="btn btn-default" type="button">Pilih Transaksi</button>
                                        <button class="btn btn-warning" type="button">Hold Transaksi</button>
                                        <button class="btn btn-primary" type="button">Tambah Barang</button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="2.5%">&nbsp;</td>
                    </tr>
                </table>
                <hr/>
                <table class="table table-bordered" width="100%">
                    <tr>
                        <td width="5%">No</td>
                        <td width="70%">Nama Barang</td>
                        <td width="12.5%">Harga</td>
                        <td width="7.5%">Qty</td>
                        <td width="15%">Jumlah</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script language="JavaScript">
    var tanggallengkap = new String();
    var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
    namahari = namahari.split(" ");
    var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
    namabulan = namabulan.split(" ");
    var tgl = new Date();
    var hari = tgl.getDay();
    var tanggal = tgl.getDate();
    var bulan = tgl.getMonth();
    var tahun = tgl.getFullYear();
    tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;
	$("#tanggalnow").val(tanggallengkap);
</script>
<script>
    $('.js-data-pelanggan-ajax').select2({
           minimumInputLength: 1,
           allowClear: true,
           placeholder: 'Masukan Nama Pelanggan atau Kode Pelanggan',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url('/attribute/getpelanggan') ?>',
              delay: 800,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function (data, page) {
              return {
                results: data
              };
            },
          }
      });
</script>