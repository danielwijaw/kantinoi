<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Master Data Pelanggan</h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
        	<div class="table-responsive" id="masterpelangganajax">
                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalpelanggan" class="modal fade" role="dialog" style="overflow:hidden;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data Master Data Pelanggan</h4>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0)" method="POST" id="formdatapelanggan">
        <div class="col-md-12">
            <label>Nomor ID Pelanggan</label>
            <input type="text" class="form-control" placeholder="Kosongkan untuk mendapat nomor ID secara acak " name="reg_pelanggan" /><br/>
            <label>Nama Pelanggan</label>
            <input type="text" class="form-control" placeholder="Masukan Data Pelanggan " name="pelanggan" /><br/>
        </div><br/>&nbsp;
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="tambahdatapelanggan()">Tambah Data</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modalpelanggancari" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cari Data Pelanggan</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-9">
            <input type="text" id="pencarianpelanggan" class="form-control" placeholder="Masukan Key Pencarian Data Pelanggan">
        </div>
        <div class="col-md-3"><button class="btn btn-primary btn-sm" onclick="caripelanggan()">Cari</button></div>
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
        $( "#masterpelangganajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/masterajax/pelanggan') ?>",
        success: function(data) {
            $('#masterpelangganajax').html(data);        
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
  function tambahdatapelanggan()
  {
    if($("input[name='pelanggan']").val().length===0){
      alert("Data Pelanggan Wajib Diisi");
      return false;
    }
    var a = new FormData(document.getElementById("formdatapelanggan"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/insertdatapelanggan') ?>",
        type: "POST",
        data: a,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data) {
          if(data == "Berhasil"){
            alert("Berhasil Input Data Data Pelanggan");
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

  function caripelanggan(){
    var pencarian = $("#pencarianpelanggan").val();
    $( "#masterpelangganajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/masterajax/pelanggan/?cari=') ?>"+pencarian,
        success: function(data) {
            $('#masterpelangganajax').html(data);        
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