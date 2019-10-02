<style>
    select[readonly].select2-hidden-accessible + .select2-container {
    pointer-events: none;
    touch-action: none;

    .select2-selection {
        background: #eee;
        box-shadow: none;
    }

    .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
        display: none;
    }
}
</style>
<form id="kasirpost" action="javascript:void(0)" method="POST">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title titlealert">Transaksi Penjualan #<?php echo $nomor_transaksi_penjualan ?></h3>
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
                                <input type="hidden" name="jumlah_barang_stok" class="clean">
                                <!-- HARGA BARANG -->
                                <input type="hidden" name="harga_barang_retail" class="clean">
                                <input type="hidden" name="harga_barang_grosir" class="clean">
                                <!-- NAMA BARANG -->
                                <input type="hidden" name="nama_barang_stok" class="clean">
                                <!-- SATUAN BARANG -->
                                <input type="hidden" name="satuan_barang_stok" class="clean">
                                <tr>
                                    <td>Pelanggan</td>
                                    <td>:</td>
                                    <td><select <?php if(isset($_GET['text'])){ ?> readonly=readonly <?php } ?> class="js-data-pelanggan-ajax form-control" width="100%" name="pelanggan_kasir" id="pelanggan_kasir">
                                    <?php if(isset($_GET['text'])){ ?>
                                    <option selected="selected" value="<?php echo $_GET['val'] ?>"><?php echo $_GET['text'] ?></option>
                                    <?php } ?>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align:left">
                                        <button id="btn-pilih-transaksi-kasir" class="btn btn-sm btn-default" type="button" data-toggle="modal" data-target="#selecttransaction" onclick="viewholding()">Pilih Transaksi</button>
                                        <button id="btn-hold-payment-kasir" class="btn btn-sm btn-warning" type="button" onclick="holdingpayment()">Hold Transaksi</button>
                                        <button class="btn btn-sm btn-primary" type="button" id="btn-tambahbarang" onclick="submitkasir()">Tambah Barang</button>
                                        <button id="btn-payment-transaction-kasir" class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#paymenttransaction">Pembayaran Transaksi</button>
                                        <button id="btn-pilih-barang-kasir" class="btn btn-sm btn-default" type="button" data-toggle="modal" data-target="#selectbarang" style="margin-top:1vh" onclick="viewbarang()">Pilih Barang</button>
                                        <button id="btn-cetak-transaksi" class="btn btn-sm btn-default" type="button" data-toggle="modal" data-target="#cetaktransaksi" style="margin-top:1vh" onclick="cetaktransaksi()">Pilih Cetak Nota</button>
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
                                    <td width="45%"><input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control clean" name="kode_barang"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>:</td>
                                    <td><input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control clean" name="jumlah_barang"></td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>:</td>
                                    <td><input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control clean" name="diskon_harga"></td>
                                </tr>
                            </table>
                        </td>
                        <td width="2.5%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div><b>ESC</b> = Close Modal & Reset Pelanggan || <b>Ctrl + `</b> = Pilih Transaksi || <b>Ctrl + 1</b> = Pilih Pelanggan || <b>Ctrl + H</b> = Holding Transaksi || <b>Ctrl + F</b> = Pembayaran Transaksi || <b>Ctrl + B</b> = Pilih Barang || <b>Ctrl + I</b> = Input Kode Barang || <b>Ctrl + J</b> = Input Jumlah Barang || <b>Ctrl + R</b> = Reload Transaksi Kasir || <b>Ctrl + D</b> = Hapus Transaksi Kasir Keseluruhan || <b>Ctrl + P</b> = Pilih Cetak Nota Transaksi</div>
                        </td>
                    </tr>
                </table>
                <hr/>
                <div id="view_transaction_now"></div>
            </div>
        </div>
    </div>
</div>
</form>
<div id="cetaktransaksi" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pilih Transaksi Untuk Di Cetak</h4>
      </div>
      <div class="modal-body">
        <div id="print_here"></div>
      </div>
    </div>

  </div>
</div>
<div id="selecttransaction" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pilih Transaksi</h4>
      </div>
      <div class="modal-body">
        <div id="transaction_here"></div>
      </div>
    </div>

  </div>
</div>

<div id="selectbarang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pilih Barang</h4>
      </div>
      <div class="modal-body">
        <div id="barang_here"></div>
      </div>
    </div>

  </div>
</div>

<div id="modalcarikasir" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cari Stok Barang</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-9">
            <input type="text" id="caribarangkasir" class="form-control" placeholder="Masukan Key Pencarian Stok Barang">
        </div>
        <div class="col-md-3"><button class="btn btn-primary btn-sm" data-dismiss="modal" onclick="carikasirstok()">Cari</button></div>
      </div>
      <div class="modal-footer">
        &nbsp;
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
    viewtransaction();
    viewholding();
    cetaktransaksi();
    $("input[name='kode_barang']").focus();
    jQuery(document).keydown(function(event) {
            if (event.keyCode === 27){
                // ESC
                $("#pelanggan_kasir").val('').change();
                $('.modal').modal('hide');
                event.preventDefault();
                return false;
            }
            if((event.ctrlKey || event.metaKey) && event.which == 49) {
                // Ctrl + 1
                // Select Pelanggan
                $("#pelanggan_kasir").select2('open');
                event.preventDefault();
                return false;
            }
            if((event.ctrlKey || event.metaKey) && event.which == 192) {
                // Ctrl + `
                // Pilih Transaksi Hold
                $("#btn-pilih-transaksi-kasir").focus();
                $("#btn-pilih-transaksi-kasir").click();
                event.preventDefault();
                return false;
            }
            if((event.ctrlKey || event.metaKey) && event.which == 72) {
                // Ctrl + h
                // Hold Transaksi
                $("#btn-hold-payment-kasir").focus();
                $("#btn-hold-payment-kasir").click();
                event.preventDefault();
                return false;
            }
            if((event.ctrlKey || event.metaKey) && event.which == 70) {
                // Ctrl + F
                // Pembayaran Transaksi
                $("#btn-payment-transaction-kasir").focus();
                $("#btn-payment-transaction-kasir").click();
                event.preventDefault();
                return false;
            }
            if((event.ctrlKey || event.metaKey) && event.which == 66) {
                // Ctrl + B
                // Pilih Barang
                $("#btn-pilih-barang-kasir").focus();
                $("#btn-pilih-barang-kasir").click();
                event.preventDefault();
                return false;
            }
            if((event.ctrlKey || event.metaKey) && event.which == 73) {
                // Ctrl + I
                // Kode Barang
                $("input[name='kode_barang']").focus();
                event.preventDefault();
                return false;
            }
            if((event.ctrlKey || event.metaKey) && event.which == 74) {
                // Ctrl + J
                // Jumlah Barang
                $("input[name='jumlah_barang']").focus();
                event.preventDefault();
                return false;
            }
            if((event.ctrlKey || event.metaKey) && event.which == 82) {
                // Ctrl + R
                // Reset
                $("#reset_kasir").click();
                event.preventDefault();
                return false;
            }
            if((event.ctrlKey || event.metaKey) && event.which == 68) {
                // Ctrl + D
                // Delete
                $("#btn-delete-transaction").click();
                event.preventDefault();
                return false;
            }
            if ((event.ctrlKey || event.metaKey) && event.keyCode === 80){
                // Ctrl + P
                // SELECT PRINT
                $("#btn-cetak-transaksi").click();
                event.preventDefault();
                return false;
            }
        }
    );
    $(document).on('keyup', function(e){
        console.log(e.keyCode);
    })
    $("input[name='kode_barang']").on('keyup', function (e) {
        if (e.keyCode === 13) {
            // ENTER
            kodebarangenter();
        }
    });
    $("input[name='jumlah_barang']").on('keyup', function (e) {
        if (e.keyCode === 13) {
            // ENTER
            jumlahbarangenter();
        }
    });
    $("#pelanggan_kasir").on('select2:select', function (e) {
        $("input[name='diskon_harga']").val($("input[name='harga_barang_grosir']").val());
        var selected_element = $(e.currentTarget);
        var select_val = selected_element.val();
        var select_text = selected_element.text();
    });
    $("#pelanggan_kasir").on('select2:close', function (e) {
        $("#btn-tambahbarang").focus();
    });
    $('.js-data-pelanggan-ajax').select2({
           minimumInputLength: 0,
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
    function submitkasir()
    {
        // PROSES CARI ULANG KODE BARANG
        $(".titlealert").html("LOADING.........................");
        $(".titlealert").html("PROSES CARI ULANG KODE BARANG........................");
        console.log("PROSES CARI ULANG KODE BARANG");
        var kodebarang = $("input[name='kode_barang']").val();
        $.ajax({
        url: '<?php echo base_url('/attribute/getbarang/?kodebarang=') ?>'+kodebarang,
        success: function(data) {
            var jsonget = $.parseJSON(data);
            var jsonurl = jsonget[0];
            if(jsonurl === null){
                alert("KODE BARANG TIDAK TEPAT / BARANG BELUM DIMASUKAN");
                $(".clean").val("");
                $("input[name='kode_barang']").focus();
                return false;
            }else{
                if(jsonurl['jumlahbarang']==="HABIS"){
                    alert("JUMLAH BARANG HABIS");
                    $("input[name='kode_barang']").focus();
                    return false;
                }else{
                    // PROSES INPUT KE VALUE
                    $(".titlealert").html("PROSES INPUT KE VALUE........................");
                    console.log("PROSES INPUT KE VALUE");
                    $("input[name='jumlah_barang_stok']").val(jsonurl['jumlahbarang']);
                    $("input[name='harga_barang_grosir']").val(jsonurl['hargabarang_grosir']);
                    $("input[name='harga_barang_retail']").val(jsonurl['hargabarang_retail']);
                    $("input[name='nama_barang_stok']").val(jsonurl['stokbarang']);
                    $("input[name='satuan_barang_stok']").val(jsonurl['satuan']);
                    // PROSES CHECKING STOK BARANG
                    $(".titlealert").html("PROSES CHECKING STOK BARANG........................");
                    console.log("PROSES CHECKING STOK BARANG");
                    if(parseFloat($("input[name='jumlah_barang']").val()) > parseFloat($("input[name='jumlah_barang_stok']").val())){
                        alert("JUMLAH STOK TIDAK TERSEDIA, STOK TERSEDIA = "+$("input[name='jumlah_barang_stok']").val());
                        $("input[name='jumlah_barang']").focus();
                        return false;
                    }else{
                        // PROSES CHECKING DISKON ATAU TIDAK
                        console.log("PROSES CHECKING DISKON ATAU TIDAK");
                        $(".titlealert").html("PROSES CHECKING DISKON ATAU TIDAK........................");
                        var kasirpost = new FormData(document.getElementById("kasirpost"));
                        $.ajax({
                            url: "<?php echo base_url('/kasirtr/insert') ?>",
                            type: "POST",
                            data: kasirpost,
                            contentType: false,       
                            cache: false,             
                            processData:false,
                            success: function(data) {
                                if(data == "Berhasil"){
                                    $(".titlealert").html("Berhasil........................");
                                    window.location.reload(true);
                                    return false;
                                }else{
                                    $(".titlealert").html("Some Mallfunction!!!!!!!!!!!!!!!!!!!!!!!");
                                    alert(data);
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                console.log(XMLHttpRequest.responseText); 
                                $(".titlealert").html("ERROR :( !!!!!!!!!!!!!!!!!!!!!!!!!!!");
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
                }
            }
            console.log(jsonurl);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest.responseText); 
            $(".titlealert").html("ERROR :( !!!!!!!!!!!!!!!!!!!!!!!!!!");
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
    function selectbarang(id)
    {
        $("input[name='kode_barang']").val(id);
        kodebarangenter();
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
                $(".clean").val("");
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
                    $("input[name='jumlah_barang']").focus();
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
        if(parseFloat($("input[name='jumlah_barang']").val()) > parseFloat($("input[name='jumlah_barang_stok']").val())){
            alert("JUMLAH STOK TIDAK TERSEDIA, STOK TERSEDIA = "+$("input[name='jumlah_barang_stok']").val());
            $("input[name='jumlah_barang']").focus();
            return false;
        }else{
            alert("SISA STOK BARANG SAAT INI = "+( parseFloat($("input[name='jumlah_barang_stok']").val()) - parseFloat($("input[name='jumlah_barang']").val()) ));
            <?php if(!isset($_GET['text'])){ ?>
                // $("#pelanggan_kasir").select2('open');
                $("#btn-tambahbarang").focus();
                if($("#pelanggan_kasir").val() != null){
                    $("input[name='diskon_harga']").val($("input[name='harga_barang_grosir']").val());
                }
            <?php }else{ ?>
                $("input[name='diskon_harga']").val($("input[name='harga_barang_grosir']").val());
                $("#btn-tambahbarang").focus();
            <?php } ?>
            
        }
    }
    function viewholding(){
        $('#transaction_here').html('LOADING ........');
        $.ajax({
        url: '<?php echo base_url('/kasir/holding/') ?>',
        success: function(data) {
            $('#transaction_here').html(data);
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
    function cetaktransaksi(){
        $('#print_here').html('LOADING ........');
        $.ajax({
        url: '<?php echo base_url('/kasir/finished/') ?>',
        success: function(data) {
            $('#print_here').html(data);
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
    function viewtransaction(){
        $('#view_transaction_now').html('LOADING ........');
        $.ajax({
        url: '<?php echo base_url('/kasir/transaction/?date='.date('Y-m-d').'&number_transaction='.$nomor_transaksi_penjualan) ?>',
        success: function(data) {
            $('#view_transaction_now').html(data);
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
    function holdingpayment(){
        if(confirm("Anda Yakin Akan HOLD Transaksi Saat Ini ?")){
            $('#view_transaction_now').html('LOADING ........');
            $.ajax({
                url: '<?php echo base_url('/kasirtr/holdingpayment?id='.$nomor_transaksi_penjualan) ?>',
                success: function(data) {
                    console.log(data);
                    window.location.href = "<?php echo base_url('/kasir/grosir') ?>";
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
        else{
            return false;
        }
    }
    function deleteditemkasir(id, nama_barang, id_barang, created_at, jumlah_barang){
        if(confirm("Anda Yakin Akan Menghapus "+nama_barang+" Dari Transaksi ?")){
            $('#view_transaction_now').html('LOADING ........');
            $.ajax({
                url: '<?php echo base_url('/kasirtr/deleteditemkasir') ?>',
                type: "GET",
                data: {'id':id, 'nama_barang':nama_barang, 'id_barang':id_barang, 'created_at':created_at, 'jumlah_barang':jumlah_barang},
                success: function(data) {
                    console.log(data);
                    window.location.reload(true);
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
        else{
            return false;
        }
    }
    function deletedtransaction(id){
        if(confirm("Anda Yakin Akan Menghapus/Membatalkan Transaksi #"+id+" ?")){
            $('#view_transaction_now').html('LOADING ........');
            $.ajax({
                url: '<?php echo base_url('/kasirtr/deletedtransaction?id=') ?>'+id,
                success: function(data) {
                    console.log(data);
                    window.location.href = "<?php echo base_url('/kasir/grosir') ?>";
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
        else{
            return false;
        }
    }
    function paymenttransaction(idtrans)
    {
        var paymentmethod = $("#methodpayment").val();
        var rupiah      = $("#rupiah").val();
        var totalmoney  = $("input[name='totalmoney']").val();
        var backmoney   = $("input[name='backmoney']").val();
        $.ajax({
            url: '<?php echo base_url('/kasirtr/accepttransaction?id=') ?>'+idtrans+'&method='+paymentmethod+'&rupiah='+rupiah+'&totalmoney='+totalmoney+'&backmoney='+backmoney,
            success: function(data) {
                var jsondata = JSON.parse(data);
                console.log(jsondata.alert);
                if(jsondata.alert){
                    if (confirm('Print Nota Penjualan ?')) {
                        window.open(jsondata.url+'&rupiah='+rupiah+'&totalmoney='+totalmoney+'&backmoney='+backmoney, '_blank');
                    } else {
                        $("#reset_kasir").click();
                    }
                }else{
                    alert(jsondata.alert);
                }
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
    function viewbarang(){
        $('#barang_here').html('LOADING ........');
        $.ajax({
        url: '<?php echo base_url('/attribute/barangkasir/') ?>',
        success: function(data) {
            $('#barang_here').html(data);
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
    
    function carikasirstok(){
    var pencarian = $("#caribarangkasir").val();
    $( "#barang_here" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/attribute/barangkasir/?cari=') ?>"+pencarian,
        success: function(data) {
            $('#barang_here').html(data);        
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
</script>