<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Satuan</th>
            <th>Nama Supplier</th>
            <th>Jenis Barang</th>
            <td width="4%"><center>
                <button data-toggle="modal" data-target="#modaltransaksistokbarangcari" class="btn btn-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
            </td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) { ?>
    <tr>
        <td><?php echo $value['reg_stokbarang'] ?></td>
        <td><?php echo $value['stokbarang'] ?></td>
        <td><?php echo $value['jumlahbarang'] ?></td>
        <td><?php echo $value['satuan'] ?></td>
        <td><?php echo $value['nama_supplier'] ?></td>
        <td><?php echo $value['jenisbarang'] ?></td>
        <td>
            <button class="btn btn-xs btn-warning" title="Tambah Data" data-toggle="modal" data-target="#modaltransaksiupdatestokbarang<?php echo $value['reg_stokbarang'] ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?php foreach ($data as $key => $value) { ?>
<div id="modaltransaksiupdatestokbarang<?php echo $value['reg_stokbarang'] ?>" class="modal fade" role="dialog"  style="overflow:hidden;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Penambahan Stok Barang</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
        <form action="javascript:void(0)" method="POST" id="formtransaksiupdate<?php echo $value['reg_stokbarang'] ?>">
            <label>Jumlah Barang</label>
            <input type="hidden" class="form-control" value="<?php echo $value['jumlahbarang'] ?>" name="jumlahbarangawal_updated_<?php echo $value['reg_stokbarang'] ?>" />
            <input type="text" class="form-control" placeholder="Masukan Jumlah Stok Barang " value="<?php echo $value['jumlahbarang'] ?>" name="jumlahbarang_updated_<?php echo $value['reg_stokbarang'] ?>" /><br/>
            <label>Total Piutang</label>
            <input type="text" class="form-control" placeholder="Masukan Jumlah Hutang (Kosongkan Apabila Tidak Ada Piutang) " name="piutang_created_<?php echo $value['reg_stokbarang'] ?>" /><br/>
        </form>
        </div><br/>&nbsp;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updatetransaksidatastokbarang<?php echo $value['reg_stokbarang'] ?>()">Update Data</button>
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
function updatetransaksidatastokbarang<?php echo $value['reg_stokbarang'] ?>()
  {
    if($("input[name='jumlahbarang_updated_<?php echo $value['reg_stokbarang'] ?>']").val().length===0){
      alert("Jumlah Barang Wajib Diisi");
      return false;
    }
    var a = new FormData(document.getElementById("formtransaksiupdate<?php echo $value['reg_stokbarang'] ?>"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/updatedatastokbarang?id='.$value['reg_stokbarang']) ?>",
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