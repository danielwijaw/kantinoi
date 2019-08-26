<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <td width="7%"><center>
                <button data-toggle="modal" data-target="#modalpelanggancari" class="btn btn-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
                <button data-toggle="modal" data-target="#modalpelanggan" class="btn btn-primary btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) { ?>
    <tr>
        <td><?php echo $value['reg_pelanggan'] ?></td>
        <td><?php echo $value['pelanggan'] ?></td>
        <td>
            <a onclick="return confirm('Anda Yakin Akan Menghapus Data Pelanggan?')" href="<?php echo base_url('/mastertr/hapusdatapelanggan?id='.$value['reg_pelanggan']) ?>"><button class="btn btn-xs btn-danger" title="Hapus Data"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
            <button class="btn btn-xs btn-warning" title="Update Data" data-toggle="modal" data-target="#modalupdatepelanggan<?php echo $value['reg_pelanggan'] ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?php foreach ($data as $key => $value) { ?>
<div id="modalupdatepelanggan<?php echo $value['reg_pelanggan'] ?>" class="modal fade" role="dialog"  style="overflow:hidden;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Data Pelanggan</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
        <form action="javascript:void(0)" method="POST" id="formupdate<?php echo $value['reg_pelanggan'] ?>">
            <label>Nomor ID Pelanggan</label>
            <input type="text" class="form-control" placeholder="Masukan Data Pelanggan " value="<?php echo $value['reg_pelanggan'] ?>" name="reg_pelanggan_updated_<?php echo $value['reg_pelanggan'] ?>" /><br/>
            <label>Nama Pelanggan</label>
            <input type="text" class="form-control" placeholder="Masukan Data Pelanggan " value="<?php echo $value['pelanggan'] ?>" name="pelanggan_updated_<?php echo $value['reg_pelanggan'] ?>" /><br/>
        </form>
        </div><br/>&nbsp;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updatedatapelanggan<?php echo $value['reg_pelanggan'] ?>()">Update Data</button>
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
function updatedatapelanggan<?php echo $value['reg_pelanggan'] ?>()
  {
    if($("input[name='reg_pelanggan_updated_<?php echo $value['reg_pelanggan'] ?>']").val().length===0){
      alert("Nomor ID Pelanggan Wajib Diisi");
      return false;
    }
    if($("input[name='pelanggan_updated_<?php echo $value['reg_pelanggan'] ?>']").val().length===0){
      alert("Data Pelanggan Wajib Diisi");
      return false;
    }
    var a = new FormData(document.getElementById("formupdate<?php echo $value['reg_pelanggan'] ?>"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/updatedatapelanggan?id='.$value['reg_pelanggan']) ?>",
        type: "POST",
        data: a,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data) {
          if(data == "Berhasil"){
            alert("Berhasil Updated Data Data Pelanggan");
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