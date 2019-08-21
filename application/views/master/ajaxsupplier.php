<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Supplier</th>
            <th>Jumlah Supply Barang</th>
            <th>Atasnama & Kontak</th>
            <th>Alamat</th>
            <td width="7%"><center>
                <button data-toggle="modal" data-target="#modalsuppliercari" class="btn btn-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
                <button data-toggle="modal" data-target="#modalsupplier" class="btn btn-primary btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) { ?>
    <tr>
        <td><?php echo $value['reg_supplier'] ?></td>
        <td><?php echo $value['nama_supplier'] ?></td>
        <td>&nbsp;</td>
        <td><?php echo $value['atas_nama'] ?>, <?php echo $value['kontak_supplier'] ?></td>
        <td><?php echo $value['alamat'] ?>, Desa/Kel. <?php echo $value['nama_kelurahan'] ?>, Kec. <?php echo $value['nama_kecamatan'] ?>, Kab. <?php echo $value['nama_kabupaten'] ?>, Prov. <?php echo $value['nama_provinsi'] ?></td>
        <td>
            <a onclick="return confirm('Anda Yakin Akan Menghapus Data Suplier?')" href="<?php echo base_url('/mastertr/hapusdatasuplier?id='.$value['reg_supplier']) ?>"><button class="btn btn-xs btn-danger" title="Hapus Data"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
            <button class="btn btn-xs btn-warning" title="Update Data" data-toggle="modal" data-target="#modalupdatesuplier<?php echo $value['reg_supplier'] ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?php foreach ($data as $key => $value) { ?>
<div id="modalupdatesuplier<?php echo $value['reg_supplier'] ?>" class="modal fade" role="dialog"  style="overflow:hidden;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Data Supplier</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
        <form action="javascript:void(0)" method="POST" id="formupdate<?php echo $value['reg_supplier'] ?>">
            <label>Nama Supplier</label>
            <input type="text" class="form-control" placeholder="Masukan Nama Perusahaan Supplier , Ex = PT Supplier Indonesia " value="<?php echo $value['nama_supplier'] ?>" name="nama_supplier_updated_<?php echo $value['reg_supplier'] ?>" /><br/>
            <label>Atas Nama Supplier</label>
            <input type="text" class="form-control" placeholder="Masukan Atas Nama Supplier, Ex = Susanto Wardoyo" name="atas_nama_updated_<?php echo $value['reg_supplier'] ?>"  value="<?php echo $value['atas_nama'] ?>" /><br/>
            <label>Kontak Atas Nama Supplier</label>
            <input type="text" class="form-control" placeholder="Masukan Kontak Atas Nama Supplier, Ex = 0822673893790" name="kontak_nama_updated_<?php echo $value['reg_supplier'] ?>"   value="<?php echo $value['kontak_supplier'] ?>" /><br/>
            <label>Alamat Supplier</label>
            <input type="text" class="form-control" placeholder="Masukan Alamat Supplier, Ex = 0822673893790" name="alamat_supplier_updated_<?php echo $value['reg_supplier'] ?>"  value="<?php echo $value['alamat'] ?>" /><br/>
            <label>Kelurahan, Kecamatan, Provinsi Supplier</label>
            <select class="updatedatasupplieroi<?php echo $value['reg_supplier'] ?> form-control" width="100%" name="kelurahan_supplier_updated_<?php echo $value['reg_supplier'] ?>" id="kelurahan_supplier_updated_<?php echo $value['reg_supplier'] ?>"></select>
        </form>
        </div><br/>&nbsp;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updatedatasupplier<?php echo $value['reg_supplier'] ?>()">Update Data</button>
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
$('.updatedatasupplieroi<?php echo $value['reg_supplier'] ?>').select2({
    allowClear: true,
    placeholder: '(Nama Kelurahan Yang Telah Dipilih Terletak Paling Atas)',
    ajax: {
        dataType: 'json',
        url: '<?php echo base_url('/attribute/getkelurahanlist?id='.$value['reg_supplier'].'&kel='.$value['id_kelurahan']) ?>',
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
})

function updatedatasupplier<?php echo $value['reg_supplier'] ?>()
  {
    if($("input[name='nama_supplier_updated_<?php echo $value['reg_supplier'] ?>']").val().length===0){
      alert("Nama Supplier Wajib Diisi");
      return false;
    }
    if($("input[name='atas_nama_updated_<?php echo $value['reg_supplier'] ?>']").val().length===0){
      alert("Atas Nama Supplier Wajib Diisi");
      return false;
    }
    if($("input[name='kontak_nama_updated_<?php echo $value['reg_supplier'] ?>']").val().length===0){
      alert("Kontak Atas Nama Wajib Diisi");
      return false;
    }
    if($("input[name='alamat_supplier_updated_<?php echo $value['reg_supplier'] ?>']").val().length===0){
      alert("Alamat Supplier Wajib Diisi");
      return false;
    }
     if(null==$("#kelurahan_supplier_updated_<?php echo $value['reg_supplier'] ?>").val()){
       alert("Pilihan Kelurahan Supplier Diisi");
       return false;
     }
    var a = new FormData(document.getElementById("formupdate<?php echo $value['reg_supplier'] ?>"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/updatedatasupplier?id='.$value['reg_supplier']) ?>",
        type: "POST",
        data: a,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data) {
          if(data == "Berhasil"){
            alert("Berhasil Updated Data Supplier");
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