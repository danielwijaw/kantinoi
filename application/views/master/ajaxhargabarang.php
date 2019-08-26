<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga Barang Retail</th>
            <th>Harga Barang Grosir</th>
            <td width="7%"><center>
                <button data-toggle="modal" data-target="#modalhargabarangcari" class="btn btn-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
                <button data-toggle="modal" data-target="#modalhargabarang" class="btn btn-primary btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) { ?>
    <tr>
        <td><?php echo $value['reg_hargabarang'] ?></td>
        <td><?php echo $value['stokbarang'] ?></td>
        <td><?php echo $value['hargabarang_grosir'] ?></td>
        <td><?php echo $value['hargabarang_retail'] ?></td>
        <td>
            <a onclick="return confirm('Anda Yakin Akan Menghapus Harga Barang?')" href="<?php echo base_url('/mastertr/hapusdatahargabarang?id='.$value['reg_hargabarang']) ?>"><button class="btn btn-xs btn-danger" title="Hapus Data"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
            <button class="btn btn-xs btn-warning" title="Update Data" data-toggle="modal" data-target="#modalupdatehargabarang<?php echo $value['reg_hargabarang'] ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?php foreach ($data as $key => $value) { ?>
<div id="modalupdatehargabarang<?php echo $value['reg_hargabarang'] ?>" class="modal fade" role="dialog"  style="overflow:hidden;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Harga Barang</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
        <form action="javascript:void(0)" method="POST" id="formupdate<?php echo $value['reg_hargabarang'] ?>">
            <label>Nama Barang</label>
            <input type="text" class="form-control" value="<?php echo $value['stokbarang'] ?>" readonly="readonly" /><br/>
            <label>Harga Barang Retail</label>
            <input type="hidden" value="<?php echo $value['hargabarang_retail'] ?>" name="hargabarang_awal_retail_updated_<?php echo $value['reg_hargabarang'] ?>" />
            <input type="text" class="form-control" placeholder="Masukan Harga Barang " value="<?php echo $value['hargabarang_retail'] ?>" name="hargabarang_retail_updated_<?php echo $value['reg_hargabarang'] ?>" /><br/>
            <label>Harga Barang Grosir</label>
            <input type="hidden" value="<?php echo $value['hargabarang_grosir'] ?>" name="hargabarang_awal_grosir_updated_<?php echo $value['reg_hargabarang'] ?>" />
            <input type="text" class="form-control" placeholder="Masukan Harga Barang Grosir " value="<?php echo $value['hargabarang_grosir'] ?>" name="hargabarang_grosir_updated_<?php echo $value['reg_hargabarang'] ?>" /><br/>
        </form>
        </div><br/>&nbsp;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updatedatahargabarang<?php echo $value['reg_hargabarang'] ?>()">Update Data</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php } ?>

<div style="text-align:center">
<?php echo $button ?>
</div>

<script>
<?php foreach ($data as $key => $value) { ?>
function updatedatahargabarang<?php echo $value['reg_hargabarang'] ?>()
  {
    if($("input[name='hargabarang_retail_updated_<?php echo $value['reg_hargabarang'] ?>']").val().length===0){
      alert("Harga Barang Retail Wajib Diisi");
      return false;
    }
    if($("input[name='hargabarang_grosir_updated_<?php echo $value['reg_hargabarang'] ?>']").val().length===0){
      alert("Harga Barang Grosir Wajib Diisi");
      return false;
    }
    var a = new FormData(document.getElementById("formupdate<?php echo $value['reg_hargabarang'] ?>"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/updatedatahargabarang?id='.$value['reg_hargabarang']) ?>",
        type: "POST",
        data: a,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data) {
          if(data == "Berhasil"){
            alert("Berhasil Updated Data Harga Barang");
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
<?php } ?>
</script>