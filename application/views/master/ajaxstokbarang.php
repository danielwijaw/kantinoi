<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Satuan</th>
            <th>Nama Supplier</th>
            <th>Jenis Barang</th>
            <td width="7%"><center>
                <button data-toggle="modal" data-target="#modalstokbarangcari" class="btn btn-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
                <button data-toggle="modal" data-target="#modalstokbarang" class="btn btn-primary btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button>
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
            <a onclick="return confirm('Anda Yakin Akan Menghapus Stok Barang?')" href="<?php echo base_url('/mastertr/hapusdatastokbarang?id='.$value['reg_stokbarang']) ?>"><button class="btn btn-xs btn-danger" title="Hapus Data"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
            <button class="btn btn-xs btn-warning" title="Update Data" data-toggle="modal" data-target="#modalupdatestokbarang<?php echo $value['reg_stokbarang'] ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?php foreach ($data as $key => $value) { ?>
<div id="modalupdatestokbarang<?php echo $value['reg_stokbarang'] ?>" class="modal fade" role="dialog"  style="overflow:hidden;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Stok Barang</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
        <form action="javascript:void(0)" method="POST" id="formupdate<?php echo $value['reg_stokbarang'] ?>">
            <label>Nama Barang</label>
            <input type="text" class="form-control" placeholder="Masukan Nama Barang " value="<?php echo $value['stokbarang'] ?>" name="stokbarang_updated_<?php echo $value['reg_stokbarang'] ?>" /><br/>
            <label>Jumlah Barang</label>
            <input type="hidden" class="form-control" value="<?php echo $value['jumlahbarang'] ?>" name="jumlahbarangawal_updated_<?php echo $value['reg_stokbarang'] ?>" />
            <input type="text" class="form-control" placeholder="Masukan Jumlah Stok Barang " value="<?php echo $value['jumlahbarang'] ?>" name="jumlahbarang_updated_<?php echo $value['reg_stokbarang'] ?>" /><br/>
            <label>Satuan</label>
            <input type="text" class="form-control" placeholder="Masukan Satuan Stok Barang " value="<?php echo $value['satuan'] ?>" name="satuan_updated_<?php echo $value['reg_stokbarang'] ?>" /><br/>
            <label>Supplier</label><br/>
            <select class="select-supplierupdated form-control" width="100%" name="reg_supplier_updated_<?php echo $value['reg_stokbarang'] ?>" id="reg_supplier_updated_<?php echo $value['reg_stokbarang'] ?>"></select><br/><br/>
            <label>Jenis Barang</label><br/>
            <select class="select-barangupdated form-control" width="100%" name="reg_jenisbarang_updated_<?php echo $value['reg_stokbarang'] ?>" id="reg_jenisbarang_updated_<?php echo $value['reg_stokbarang'] ?>"></select><br/><br/>
        </form>
        </div><br/>&nbsp;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updatedatastokbarang<?php echo $value['reg_stokbarang'] ?>()">Update Data</button>
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
$('#reg_jenisbarang_updated_<?php echo $value['reg_stokbarang'] ?>').select2({
        allowClear: true,
        placeholder: 'Pilih Jenis Barang , Jenis Barang Terpilih Berada Paling Atas',
        ajax: {
          dataType: 'json',
          url: '<?php echo base_url('/attribute/getjenisbarangupdated?reg='.$value['reg_jenisbarang']) ?>',
          delay: 800,
          data: function(params) {
            return {
              search: params.term
            }
          },
          processResults: function (data, page) {
          return {
            results: data
          };
        },
      }
  });
$('#reg_supplier_updated_<?php echo $value['reg_stokbarang'] ?>').select2({
        allowClear: true,
        placeholder: 'Pilih Nama Supplier , Nama Supplier Terpilih Berada Paling Atas',
        ajax: {
          dataType: 'json',
          url: '<?php echo base_url('/attribute/getsupplierupdated?reg='.$value['reg_supplier']) ?>',
          delay: 800,
          data: function(params) {
            return {
              search: params.term
            }
          },
          processResults: function (data, page) {
          return {
            results: data
          };
        },
      }
  });
function updatedatastokbarang<?php echo $value['reg_stokbarang'] ?>()
  {
    if($("input[name='stokbarang_updated_<?php echo $value['reg_stokbarang'] ?>']").val().length===0){
      alert("Nama Barang Wajib Diisi");
      return false;
    }
    if($("input[name='jumlahbarang_updated_<?php echo $value['reg_stokbarang'] ?>']").val().length===0){
      alert("Jumlah Barang Wajib Diisi");
      return false;
    }
    if($("input[name='satuan_updated_<?php echo $value['reg_stokbarang'] ?>']").val().length===0){
      alert("Satuan Barang Wajib Diisi");
      return false;
    }
    if($("#reg_supplier_updated_<?php echo $value['reg_stokbarang'] ?>").val().length===0){
      alert("Nama Supplier Wajib Diisi");
      return false;
    }
    if($("#reg_jenisbarang_updated_<?php echo $value['reg_stokbarang'] ?>").val().length===0){
      alert("Jenis Barang Wajib Diisi");
      return false;
    }
    var a = new FormData(document.getElementById("formupdate<?php echo $value['reg_stokbarang'] ?>"));
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