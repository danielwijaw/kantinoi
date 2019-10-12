<?php error_reporting(0); if(!isset($_GET['nofak'])){ $_GET['nofak']=='0'; } ?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title titlealert">Retur Pembelian Stokbarang By Faktur</h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
            <div class="table-responsive">
                <table width="100%">
                    <tr>
                        <td style="text-align:left">
                            <button id="btn-pilih-barang" class="btn btn-sm btn-default" type="button" data-toggle="modal" data-target="#selectbarang" onclick="nomorecuk()">Pilih Nomor Faktur</button>
                            <button class="btn btn-sm btn-default" type="button" onclick="reload()">Reset Nomor Faktur</button>
                            <a href="<?php echo base_url('/attribute/printfaktur/?nofak='.$_GET['nofak']) ?>" target="_blank"><button class="btn btn-sm btn-default" type="button">Cetak Retur By Nomor Faktur</button></a>
                        </td>
                    </tr>
                </table>
                <hr/>
                <div id="barangendi"></div>
            </div>
        </div>
    </div>
</div>
<div id="selectbarang" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pilih Nomor Faktur</h4>
      </div>
      <div class="modal-body">
        <div id="nangkene"></div>
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

<div id="modaloutbarang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Retur Barang</h4>
      </div>
      <div class="modal-body">
        <div id="asdsadasda"></div>
      </div>
      <div class="modal-footer">
        &nbsp;
      </div>
    </div>

  </div>
</div>
<script>
    function reload(){
        window.location.href = '<?php echo base_url('/master/returnpembelian/') ?>';
    }
    function submitdatabarang(id, reg_stokbarang){
        var val = $('#stokretur').val();
        $('#asdsadasda').html('LOADING ........');
        $.ajax({
        url: '<?php echo base_url('/attribute/processs/?id=') ?>'+id+'&idbarang='+reg_stokbarang+'&val='+val,
        success: function(data) {
            location.reload();
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
    };
    function modaloutbarangnya(id){
        $('#asdsadasda').html('LOADING ........');
        $.ajax({
        url: '<?php echo base_url('/attribute/databarangbyid/?id=') ?>'+id,
        success: function(data) {
            $('#asdsadasda').html(data);
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
    };
    function nomorecuk(){
        $('#ngenehbarange').html('LOADING ........');
        $.ajax({
        url: '<?php echo base_url('/attribute/nomorfakturcuk/') ?>',
        success: function(data) {
            $('#nangkene').html(data);
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
    };
    function caristokbarang(){
    var pencarian = $("#pencariantransaksistokbarang").val();
    $( "#nangkene" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/attribute/nomorfakturcuk/?cari=') ?>"+pencarian,
        success: function(data) {
            $('#nangkene').html(data);        
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
    };
    <?php if(isset($_GET['nofak'])){ ?>
        goletilahdatane();
    <?php } ?>
    function goletilahdatane(){
        $('#barangendi').html('LOADING ........');
        $.ajax({
        url: '<?php echo base_url('/attribute/listbarangefaktur/?nofak='.$_GET['nofak']) ?>',
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
    };
</script>