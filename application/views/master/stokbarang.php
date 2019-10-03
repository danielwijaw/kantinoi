<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Master Data Stok Barang</h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
        	<div class="table-responsive" id="masterstokbarangajax">
                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalstokbarang" class="modal fade" role="dialog" style="overflow:true;">
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
            <label>Nomor Faktur</label>
            <input type="text"  class="form-control" placeholder="Masukan Nomor Faktur" name="nofak" /><br/>
			<label>Jumlah Barang</label>
            <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" placeholder="Masukan Jumlah Stok Barang " name="jumlahbarang" /><br/>
            <label>Satuan</label>
            <input type="text" class="form-control" placeholder="Masukan Satuan Stok Barang " name="satuan" /><br/>
            <label>Supplier</label><br/>
            <select class="select-supplier form-control" width="100%" name="reg_supplier" id="reg_supplier"></select><br/><br/>
            <label>Jenis Barang</label><br/>
            <select class="select-jbar form-control" width="100%" name="reg_jenisbarang" id="reg_jenisbarang"></select><br/><br/>
            <label>Total Harga Barang Datang</label>
            <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" placeholder="Masukan Total Harga Barang Datang" name="reg_hargabarang" /><br/>
            <label>PPN Harga Barang Datang (%)</label>
            <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" placeholder="Masukan PPN Barang Datang" name="reg_ppnbarang" /><br/>
            <label>Diskon Barang Datang (Rupiah)</label>
            <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" placeholder="Masukan Total Diskon Barang Datang" name="reg_diskonbarang" /><br/>
            <label>Total Piutang</label>
            <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" placeholder="Masukan Jumlah Hutang" name="piutang" /><br/>
        </div><br/>&nbsp;
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="tambahdatastokbarang()">Tambah Data</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modalstokbarangcari" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cari Stok Barang</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-9">
            <input type="text" id="pencarianstokbarang" class="form-control" placeholder="Masukan Key Pencarian Stok Barang">
        </div>
        <div class="col-md-3"><button class="btn btn-primary btn-sm" onclick="caristokbarang()">Cari</button></div>
      </div>
      <div class="modal-footer">
        &nbsp;
      </div>
    </div>

  </div>
</div>

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
    loaddatastokbarang();
    function loaddatastokbarang()
    {
        $( "#masterstokbarangajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/masterajax/stokbarang') ?>",
        success: function(data) {
            $('#masterstokbarangajax').html(data);        
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
  function tambahdatastokbarang()
  {
    if($("input[name='stokbarang']").val().length===0){
      alert("Nama Barang Wajib Diisi");
      return false;
    }
    if($("input[name='jumlahbarang']").val().length===0){
      alert("Jumlah Barang Wajib Diisi");
      return false;
    }
    if($("input[name='satuan']").val().length===0){
      alert("Satuan Barang Wajib Diisi");
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
    if($("input[name='reg_hargabarang']").val().length===0){
      alert("Total Harga Barang Wajib Diisi");
      return false;
    }
    if($("input[name='reg_ppnbarang']").val().length===0){
      alert("PPN Barang Wajib Diisi");
      return false;
    }
    if($("input[name='reg_diskonbarang']").val().length===0){
      alert("Diskon Wajib Diisi");
      return false;
    }
    if($("input[name='piutang']").val().length===0){
      alert("Piutang Wajib Diisi");
      return false;
    }
    var a = new FormData(document.getElementById("formdatastokbarang"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/insertdatastokbarang') ?>",
        type: "POST",
        data: a,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data) {
          if(data == "Berhasil"){
            alert("Berhasil Input Data Stok Barang");
            window.location.reload(true);
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

  function caristokbarang(){
    var pencarian = $("#pencarianstokbarang").val();
    $( "#masterstokbarangajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/masterajax/stokbarang/?cari=') ?>"+pencarian,
        success: function(data) {
            $('#masterstokbarangajax').html(data);        
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