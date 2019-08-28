<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Transaksi Penjualan #<?php echo $nomor_transaksi_penjualan ?></h3>
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

                                <!-- NOMOR TRANSAKSI PENJUALAN -->
                                <input type="hidden" value="<?php echo $nomor_transaksi_penjualan ?>" name="nomor_transaksi_penjualan">
                                <!-- TANGGAL TRANSAKSI PENJUALAN -->
                                <input type="hidden" value="<?php echo date('Y-m-d') ?>" name="tanggal_transaksi_penjualan">
                                <!-- ADMIN -->
                                <input type="hidden" value="<?php echo $this->session->userdata('nip') ?>" name="admin_transaksi_penjualan">
                                <!-- JUMLAH BARANG -->
                                <input type="hidden" name="jumlah_barang_stok">
                                <!-- HARGA BARANG -->
                                <input type="hidden" name="harga_barang_retail">
                                <input type="hidden" name="harga_barang_grosir">
                                <!-- NAMA BARANG -->
                                <input type="hidden" name="nama_barang_stok">
                                <!-- SATUAN BARANG -->
                                <input type="hidden" name="satuan_barang_stok">

                                <tr>
                                    <td>Pelanggan</td>
                                    <td>:</td>
                                    <td><select class="js-data-pelanggan-ajax form-control" width="100%" name="pelanggan_kasir" id="pelanggan_kasir"></select></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align:left">
                                        <button class="btn btn-default" type="button">Pilih Transaksi</button>
                                        <button class="btn btn-warning" type="button">Hold Transaksi</button>
                                        <button class="btn btn-primary" type="button" id="btn-tambahbarang" onclick="submit()">Tambah Barang</button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="2.5%">&nbsp;</td>
                        <td width="47.5%">
                            <table width="100%" class="table">
                                <tr>
                                    <td width="50%">Kode Barang / Barcode</td>
                                    <td width="5%">:</td>
                                    <td width="45%"><input type="text" class="form-control" name="kode_barang"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" name="jumlah_barang"></td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" name="diskon_harga"></td>
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
                        <td width="65%">Nama Barang</td>
                        <td width="12.5%">Harga</td>
                        <td width="7.5%">Qty</td>
                        <td width="15%">Jumlah</td>
                        <td width="5%">&nbsp;</td>
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
    $("input[name='kode_barang']").focus();
    $(document).on('keyup', function(e){
        if (e.keyCode === 27){
            // ESC
            $("#pelanggan_kasir").val('').change();
        }
    })
    $("input[name='kode_barang']").on('keyup', function (e) {
        if (e.keyCode === 13) {
            // ENTER
            kodebarangenter();
            $("input[name='jumlah_barang']").focus();
        }
    });
    $("input[name='jumlah_barang']").on('keyup', function (e) {
        if (e.keyCode === 13) {
            // ENTER
            jumlahbarangenter();
            $("#pelanggan_kasir").select2('open');
        }
    });
    $("#pelanggan_kasir").on('select2:select', function (e) {
        $("input[name='diskon_harga']").val($("input[name='harga_barang_grosir']").val())
        $("#btn-tambahbarang").focus();
    });
    $("#pelanggan_kasir").on('select2:close', function (e) {
        $("#btn-tambahbarang").focus();
    });
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
    $("#btn-tambahbarang").on('keyup', function (e) {
        if (e.keyCode === 13) {
            // ENTER
            submit();
        }
    });
    function submit(){
        kodebarangenter();
        jumlahbarangenter();
    }
    function kodebarangenter(){
        var kodebarang = $("input[name='kode_barang']").val();
        $.ajax({
        url: '<?php echo base_url('/attribute/getbarang/?kodebarang=') ?>'+kodebarang,
        success: function(data) {
            var jsonget = $.parseJSON(data);
            var jsonurl = jsonget[0];
            if(jsonurl === null){
                alert("KODE BARANG TIDAK TEPAT / BARANG BELUM DIMASUKAN");
                return false;
            }else{
                if(jsonurl['jumlahbarang']==="HABIS"){
                    alert("JUMLAH BARANG HABIS");
                    $("input[name='kode_barang']").focus();
                    return false;
                }else{
                    alert("Nama Barang = "+jsonurl['stokbarang']+" Harga Grosir = "+jsonurl['hargabarang_grosir']+" Harga Retail = "+jsonurl['hargabarang_retail']);
                    $("input[name='jumlah_barang_stok']").val(jsonurl['jumlahbarang']);
                    $("input[name='harga_barang_grosir']").val(jsonurl['hargabarang_grosir']);
                    $("input[name='harga_barang_retail']").val(jsonurl['hargabarang_retail']);
                    $("input[name='nama_barang_stok']").val(jsonurl['stokbarang']);
                    $("input[name='satuan_barang_stok']").val(jsonurl['satuan']);
                }
            }
            console.log(jsonurl);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest.responseText); 
            if (XMLHttpRequest.status == 0) {
            alert(' Check Your Network.');
            } else if (XMLHttpRequest.status == 404) {
            alert('Requested URL not found.');
            } else if (XMLHttpRequest.status == 500) {
            alert('Internel Server Error.');
            }  else {
            alert('Unknow Error.\n' + XMLHttpRequest.responseText);
            }     
        }
        });
    }
    function jumlahbarangenter(){
        if($("input[name='jumlah_barang']").val() >= $("input[name='jumlah_barang_stok']").val()){
            alert("JUMLAH STOK TIDAK TERSEDIA, STOK TERSEDIA = "+$("input[name='jumlah_barang_stok']").val());
            $("input[name='jumlah_barang']").focus();
            return false;
        }else{
            // alert('lanjut');
            console.log("LANJUT");
        }
    }
</script>