<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Stok Barang</th>
            <td width="7%"><center>
                <button data-toggle="modal" data-target="#modalstokbarangcari" class="btn btn-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
                <button data-toggle="modal" data-target="#modalstokbarang" class="btn btn-primary btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) { ?>
    <tr>
        <td><?php echo $value['reg_jenisbarang'] ?></td>
        <td><?php echo $value['jenisbarang'] ?></td>
        <td>
            <a onclick="return confirm('Anda Yakin Akan Menghapus Stok Barang?')" href="<?php echo base_url('/mastertr/hapusdatastokbarang?id='.$value['reg_jenisbarang']) ?>"><button class="btn btn-xs btn-danger" title="Hapus Data"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
            <button class="btn btn-xs btn-warning" title="Update Data" data-toggle="modal" data-target="#modalupdatestokbarang<?php echo $value['reg_jenisbarang'] ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?php foreach ($data as $key => $value) { ?>
<div id="modalupdatestokbarang<?php echo $value['reg_jenisbarang'] ?>" class="modal fade" role="dialog"  style="overflow:hidden;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Stok Barang</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
        <form action="javascript:void(0)" method="POST" id="formupdate<?php echo $value['reg_jenisbarang'] ?>">
            <label>Stok Barang</label>
            <input type="text" class="form-control" placeholder="Masukan Stok Barang " value="<?php echo $value['jenisbarang'] ?>" name="stokbarang_updated_<?php echo $value['reg_jenisbarang'] ?>" /><br/>
        </form>
        </div><br/>&nbsp;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updatedatastokbarang<?php echo $value['reg_jenisbarang'] ?>()">Update Data</button>
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
function updatedatastokbarang<?php echo $value['reg_jenisbarang'] ?>()
  {
    if($("input[name='stokbarang_updated_<?php echo $value['reg_jenisbarang'] ?>']").val().length===0){
      alert("Stok Barang Wajib Diisi");
      return false;
    }
    var a = new FormData(document.getElementById("formupdate<?php echo $value['reg_jenisbarang'] ?>"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/updatedatastokbarang?id='.$value['reg_jenisbarang']) ?>",
        type: "POST",
        data: a,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data) {
          if(data == "Berhasil"){
            alert("Berhasil Updated Data Stok Barang");
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