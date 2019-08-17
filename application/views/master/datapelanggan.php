<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Master Data Pelanggan</h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
        	<div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Harga Grosir</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="masterstokbarangajax"></tbody>
                </table>
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
</script>