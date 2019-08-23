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
<div id="modalstokbarang" class="modal fade" role="dialog" style="overflow:hidden;">
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
            <label>Stok Barang</label>
            <input type="text" class="form-control" placeholder="Masukan Stok Barang " name="stokbarang" /><br/>
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
      alert("Stok Barang Wajib Diisi");
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