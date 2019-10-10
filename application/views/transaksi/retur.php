<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Retur & Batal Transaksi Penjualan</h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
        	<div class="table-responsive" id="returajax">
                
            </div>
        </div>
    </div>
</div>

<script>
    loaddatastokbarang();
    function loaddatastokbarang()
    {
        $( "#returajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/transaksiC/returajax') ?>",
        success: function(data) {
            $('#returajax').html(data);        
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