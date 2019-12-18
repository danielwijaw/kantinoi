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
                                    <td>Total Piyutang Barang Datang (Rupiah)&nbsp;<input type="checkbox" id="utangenongol" value="true"></td>
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
                                        <button class="btn btn-sm btn-primary" type="button" id="btn-ngitung" onclick="ngitungjuh()">Total Harga</button>
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
                                    <td id="hargalamaboss">Harga Satuan Barang Datang</td>
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
  <div class="modal-dialog modal-lg">

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

<!-- Modal -->
<div id="modalenambah" class="modal fade" role="dialog" style="overflow:true;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data Master Stok Barang</h4>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0)" method="POST" id="formdatastokbarang">
        <div class="col-md-12">
            <label>ID Barang</label>
            <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" placeholder="Masukan ID Barang, Kosongkan Untuk Mendapat ID Secara Otomatis" name="reg_stokbarang" /><br/>
            <label>Nama Barang</label>
            <input type="text" class="form-control" placeholder="Masukan Nama Barang" name="stokbarang" /><br/>
			<label>Jumlah Barang</label>
            <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" placeholder="Masukan Jumlah Stok Barang " name="jumlahbarang" /><br/>
            <label>Satuan</label>
            <input type="text" class="form-control" placeholder="Masukan Satuan Stok Barang " name="satuan" /><br/>
            <label>Supplier</label><br/>
            <select class="select-supplier form-control" width="100%" name="reg_supplier" id="reg_supplier"></select><br/><br/>
            <label>Jenis Barang</label><br/>
            <select class="select-jbar form-control" width="100%" name="reg_jenisbarang" id="reg_jenisbarang"></select><br/><br/>
        </div><br/>&nbsp;
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="stokebarangnambah()">Tambah Data</button>
        <button type="button" class="btn btn-default" id="btn-close-tambah-barang" data-dismiss="modal">Close</button>
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
    $('#reg_jenisbarang').select2({
           allowClear: true,
           placeholder: 'Pilih Jenis Barang',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url('/attribute/getjenisbarang') ?>',
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
    $('#reg_supplier').select2({
           allowClear: true,
           placeholder: 'Pilih Nama Supplier',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url('/attribute/getsupplier') ?>',
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
      function stokebarangnambah()
    {
    if($("input[name='stokbarang']").val().length===0){
      alert("Nama Barang Wajib Diisi");
      return false;
    }
    if($("input[name='satuan']").val().length===0){
      alert("Satuan Barang Wajib Diisi");
      return false;
    }
    if($("input[name='jumlahbarang']").val().length===0){
      alert("Jumlah Barang Wajib Diisi");
      return false;
    }
    if($("select[name='reg_supplier']").val().length===0){
      alert("Nama Supplier Wajib Diisi");
      return false;
    }
    if($("select[name='reg_jenisbarang']").val().length===0){
      alert("Jenis Barang Wajib Diisi");
      return false;
    }
    var a = new FormData(document.getElementById("formdatastokbarang"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/insertdatastokbarangfaktur') ?>",
        type: "POST",
        data: a,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data) {
          if(data == "Berhasil"){
            $('#btn-close-tambah-barang').click();
            ndelengbarange();
            return false;
          }else{
            alert(data);
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
        $.ajax({
            url: "<?php echo base_url('/attribute/getdatahargabelicuk/?id=') ?>"+id['reg_stok']+"&jsononly=true",
            success: function(data) {
                $('#hargalamaboss').html("Harga Satuan Barang Datang<br/><b>Harga Sebelumnya / Barang = "+data+"</b>");        
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
    function insertsu()
    {
        if($("input[name='nofak']").val().length===0){
            alert("Nomor Faktur Wajib Diisi");
            $("input[name='nofak']").focus();
            return false;
        }
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
    
    function ngitungjuh()
    {
        if($("input[name='nofak']").val().length===0){
            alert("Nomor Faktur Wajib Diisi");
            $("input[name='nofak']").focus();
            return false;
        }
        if($("input[name='piyutang_total']").val().length===0){
            alert("Total Piyutang Wajib Diisi");
            $("input[name='piyutang_total']").focus();
            return false;
        }
        if($("input[name='ppn_total']").val().length===0){
            alert("PPN Wajib Diisi");
            $("input[name='ppn_total']").focus();
            return false;
        }
        if($("input[name='diskon_total']").val().length===0){
            alert("Total Diskon Harga Barang Wajib Diisi");
            $("input[name='diskon_total']").focus();
            return false;
        }
        var formbarangcuk = new FormData(document.getElementById("formbarangcuk"));
        $.ajax({
            url: "<?php echo base_url('/kasirtr/ngitungtokjud') ?>",
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
</script>