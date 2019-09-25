<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Transaksi Piutang Stok Barang</h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
        	<div class="table-responsive" id="mastertransaksistokbarangajax">
                
            </div>
        </div>
    </div>
</div>

<div id="modaltransaksistokbarangcari" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cari Stok Barang</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-9">
            <input type="text" id="pencariantransaksistokbarang" class="form-control" placeholder="Masukan Key Pencarian Stok Barang">
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
        $( "#mastertransaksistokbarangajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/transaksiC/stokbarang') ?>",
        success: function(data) {
            $('#mastertransaksistokbarangajax').html(data);        
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
    var pencarian = $("#pencariantransaksistokbarang").val();
    $( "#mastertransaksistokbarangajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/transaksiC/stokbarang/?cari=') ?>"+pencarian,
        success: function(data) {
            $('#mastertransaksistokbarangajax').html(data);        
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