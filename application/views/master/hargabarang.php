<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Master Data Harga Barang</h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
        	<div class="table-responsive" id="masterhargabarangajax">
                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalhargabarang" class="modal fade" role="dialog" style="overflow:hidden;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data Master Harga Barang</h4>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0)" method="POST" id="formdatahargabarang">
        <div class="col-md-12">
            <label>Nama Barang</label><br/>
            <select class="js-data-example-ajax form-control" width="100%" name="reg_stokbarang" id="reg_stokbarang"></select><br/><br/>
            <label>Harga Barang Grosir</label>
            <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" class="form-control" placeholder="Masukan Harga Barang " name="hargabarang_grosir" /><br/>
            <label>Harga Barang Retail</label>
            <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" class="form-control" placeholder="Masukan Harga Barang " name="hargabarang_retail" /><br/>
        </div><br/>&nbsp;
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="tambahdatahargabarang()">Tambah Data</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modalhargabarangcari" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cari Harga Barang</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-9">
            <input type="text" id="pencarianhargabarang" class="form-control" placeholder="Masukan Key Pencarian Harga Barang">
        </div>
        <div class="col-md-3"><button class="btn btn-primary btn-sm" onclick="carihargabarang()">Cari</button></div>
      </div>
      <div class="modal-footer">
        &nbsp;
      </div>
    </div>

  </div>
</div>

<script>
    $('#reg_stokbarang').select2({
           allowClear: true,
           placeholder: 'Pilih Nama Barang',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url('/attribute/getnamabarang') ?>',
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
        $( "#masterhargabarangajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/masterajax/hargabarang') ?>",
        success: function(data) {
            $('#masterhargabarangajax').html(data);        
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
  function tambahdatahargabarang()
  {
    if($("#reg_stokbarang").val().length===0){
      alert("Nama Barang Wajib Diisi");
      return false;
    }
    if($("input[name='hargabarang_grosir']").val().length===0){
      alert("Harga Barang Grosir Wajib Diisi");
      return false;
    }
    if($("input[name='hargabarang_retail']").val().length===0){
      alert("Harga Barang Retail Wajib Diisi");
      return false;
    }
    var a = new FormData(document.getElementById("formdatahargabarang"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/insertdatahargabarang') ?>",
        type: "POST",
        data: a,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data) {
          if(data == "Berhasil"){
            alert("Berhasil Input Data Harga Barang");
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

  function carihargabarang(){
    var pencarian = $("#pencarianhargabarang").val();
    $( "#masterhargabarangajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/masterajax/hargabarang/?cari=') ?>"+pencarian,
        success: function(data) {
            $('#masterhargabarangajax').html(data);        
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