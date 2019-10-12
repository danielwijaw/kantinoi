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
<form id="formbarangcuk" action="javascript:void(0)" method="POST">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title titlealert">Transaksi Pembelian Stokbarang By Faktur</h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
            <div class="table-responsive">
                <table width="100%">
                    <tr>
                        <td width="47.5%" valign="top">
                            <table width="100%" class="table">
                                <tr>
                                    <td width="50%">Tanggal Input Stok Barang</td>
                                    <td width="5%">:</td>
                                    <td width="45%"><input type="text" class="form-control" id="tanggalnow" readonly="readonly"></td>
                                </tr>
                                <tr>
                                    <td>Total Piyutang Barang Datang (Rupiah)</td>
                                    <td>:</td>
                                    <td><input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control clean" name="piyutang_total"></td>
                                </tr>
                                <tr>
                                    <td>Diskon Harga Barang Datang (Rupiah)</td>
                                    <td>:</td>
                                    <td><input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control clean" name="diskon_total"></td>
                                </tr>
                                <tr>
                                    <td>PPN Harga Barang Datang (%)</td>
                                    <td>:</td>
                                    <td><input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control clean" name="ppn_total"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align:left">
                                        <button id="btn-pilih-barang" class="btn btn-sm btn-default" type="button" data-toggle="modal" data-target="#selectbarang" onclick="ndelengbarange()">Pilih Barang</button>
                                        <button class="btn btn-sm btn-primary" type="button" id="btn-tambahbarang" onclick="insertsu()">Tambah Barang</button>
                                        <button id="btn-payment-transaction" class="btn btn-sm btn-danger" type="button" onclick="refreshlahcuk()">Selesaikan Transaksi</button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="2.5%">&nbsp;</td>
                        <td width="47.5%">
                            <table width="100%" class="table">
                                <tr>
                                    <td width="50%">ID Barang</td>
                                    <td width="5%">:</td>
                                    <td width="45%"><input readonly=readonly type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control clean" name="id_barang">
                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stok Awal Barang</td>
                                    <td>:</td>
                                    <td><input type="text" readonly=readonly onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control clean" name="barang_awal"></td>
                                </tr>
                                <tr>
                                    <td>Nomor Faktur</td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="nofak" name="nofak" value="<?php echo $nomor_faktur ?>"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Barang Datang</td>
                                    <td>:</td>
                                    <td><input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control clean" name="jumlah_barang"></td>
                                </tr>
                                <tr>
                                    <td>Harga Satuan Barang Datang</td>
                                    <td>:</td>
                                    <td><input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control clean" name="total_harga"></td>
                                </tr>
                            </table>
                        </td>
                        <td width="2.5%">&nbsp;</td>
                    </tr>
                </table>
                <hr/>
                <div id="barangendi"></div>
            </div>
        </div>
    </div>
</div>
</form>
<div id="selectbarang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pilih Barang</h4>
      </div>
      <div class="modal-body">
        <div id="ngenehbarange"></div>
      </div>
    </div>

  </div>
</div>
<div id="modalcaricuk" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cari Stok Barang</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-9">
            <input type="text" id="goletbarangcuk" class="form-control" placeholder="Masukan Key Pencarian Stok Barang">
        </div>
        <div class="col-md-3"><button class="btn btn-primary btn-sm" data-dismiss="modal" onclick="klikgolet()">Cari</button></div>
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
    viewstokbarang();
    function viewstokbarang(){
        $('#barangendi').html('LOADING ........');
        $.ajax({
        url: '<?php echo base_url('/kasir/stokbarangtransaction/?date='.date('Y-m-d').'&nofak='.$nomor_faktur) ?>',
        success: function(data) {
            $('#barangendi').html(data);
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

    function ndelengbarange(){
        $('#ngenehbarange').html('LOADING ........');
        $.ajax({
        url: '<?php echo base_url('/attribute/stokbarangoi/') ?>',
        success: function(data) {
            $('#ngenehbarange').html(data);
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
    function klikgolet(){
        var pencarian = $("#goletbarangcuk").val();
        $( "#ngenehbarange" ).html( "LOADING....." );
        $.ajax({
            url: "<?php echo base_url('/attribute/stokbarangoi/?cari=') ?>"+pencarian,
            success: function(data) {
                $('#ngenehbarange').html(data);        
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
    function selectbarang(id)
    {
        console.log(id);
        $("input[name='id_barang']").val(id['reg_stok']);
        $("input[name='barang_awal']").val(id['stok']);
    }
    function insertsu()
    {
        if($("input[name='nofak']").val().length===0){
            alert("Nomor Faktur Wajib Diisi");
            $("input[name='nofak']").focus();
            return false;
        }
        // if($("input[name='piyutang_total']").val().length===0){
        //     alert("Total Piyutang Wajib Diisi");
        //     $("input[name='piyutang_total']").focus();
        //     return false;
        // }
        if($("input[name='id_barang']").val().length===0){
            alert("Barang Wajib Dipilih");
            $("#btn-pilih-barang").click();
            return false;
        }
        if($("input[name='barang_awal']").val().length===0){
            alert("Barang Wajib Dipilih");
            $("#btn-pilih-barang").click();
            return false;
        }
        if($("input[name='jumlah_barang']").val().length===0){
            alert("Jumlah Barang Wajib Diisi");
            $("input[name='jumlah_barang']").focus();
            return false;
        }
        if($("input[name='total_harga']").val().length===0){
            alert("Total Harga Barang Wajib Diisi");
            $("input[name='total_harga']").focus();
            return false;
        }
        // if($("input[name='ppn_total']").val().length===0){
        //     alert("PPN Wajib Diisi");
        //     $("input[name='ppn_total']").focus();
        //     return false;
        // }
        // if($("input[name='diskon_total']").val().length===0){
        //     alert("Total Diskon Harga Barang Wajib Diisi");
        //     $("input[name='diskon_total']").focus();
        //     return false;
        // }
        var formbarangcuk = new FormData(document.getElementById("formbarangcuk"));
        $.ajax({
            url: "<?php echo base_url('/kasirtr/nginsertdatastokbarangsu') ?>",
            type: "POST",
            data: formbarangcuk,
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(data) {
                var data = JSON.parse(data);
                if(data['echo'] == "Berhasil"){
                    $(".titlealert").html("Berhasil........................");
                    window.location.href = data['url'];
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

    function refreshlahcuk(){
        window.location.href = "<?php echo base_url('/kasir/stokbarang/') ?>";
    }
</script>