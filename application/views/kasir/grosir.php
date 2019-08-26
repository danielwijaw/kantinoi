<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title" id="tanggalnow"></h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
            <label>Transaksi Penjualan</label><hr/>
            <div class="table-responsive">
                <table width="100%">
                    <tr>
                        <td width="47.5%">
                            <table width="100%" class="table">
                                <tr>
                                    <td width="50%">No. Penjualan</td>
                                    <td width="5%">:</td>
                                    <td width="45%"><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Penjualan</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Pelanggan</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control"></td>
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
                                    <td colspan="2">&nbsp;</td>
                                    <td><button class="btn btn-primary" type="button">Tambah Barang</button></td>
                                </tr>
                            </table>
                        </td>
                        <td width="2.5%">&nbsp;</td>
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
	$("#tanggalnow").html(tanggallengkap+"&ensp;||&ensp;Login Sebagai <?php echo $this->session->userdata('nama') ?>");
</script>