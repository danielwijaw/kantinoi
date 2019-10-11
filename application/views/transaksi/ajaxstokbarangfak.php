<?php error_reporting(0); $variabledata = array(); foreach ($data as $key => $value) {
  $nofakfak = json_decode($value['harga_default'], true)['nofak'];
  if(empty($nofakfak)){
    $nofakfak = $value['id_tr_stokbarang'];
  }
  $variabledata[$nofakfak]['nama_barang'][] = $value['stokbarang'];
  $variabledata[$nofakfak]['piutang'][] = $value['piutang'];
  $variabledata[$nofakfak]['nama_supplier'][] = $value['nama_supplier'];
  $variabledata[$nofakfak]['jenisbarang'][] = $value['jenisbarang'];
} ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nomor Faktur</th>
            <th>Nama Barang</th>
            <th>Nama Supplier</th>
            <th>Jenis Barang</th>
            <th>Total Piutang</th>
            <td width="4%"><center>
                <button data-toggle="modal" data-target="#modaltransaksistokbarangcari" class="btn btn-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
            </td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) { $nofaktol = json_decode($value['harga_default'], true)['nofak'];
      if(empty($nofaktol)){
        $nofaktol = $value['id_tr_stokbarang'];
      }  
    ?>
    <tr>
        <td><?php echo $nofaktol; ?></td>
        <td>
          <?php foreach($variabledata[$nofaktol]['nama_barang'] as $kontal){
            echo $kontal."<br/>";
          }?>
        </td>
        <td><?php foreach($variabledata[$nofaktol]['nama_supplier'] as $kontal){
            echo $kontal."<br/>";
          }?></td>
        <td><?php foreach($variabledata[$nofaktol]['jenisbarang'] as $kontal){
            echo $kontal."<br/>";
          }?></td>
        <td><?php foreach($variabledata[$nofaktol]['piutang'] as $kontal){
            echo rupiah($kontal)."<br/>";
          }?><br/>Total :<?php echo rupiah(array_sum(($variabledata[$nofaktol]['piutang']))); ?></td>
        <td>
            <button class="btn btn-xs btn-warning" title="Pembayaran Piyutang" data-toggle="modal" data-target="#modaltransaksiupdatestokbarang<?php echo $nofaktol ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?php foreach ($data as $key => $value) { $nofaktol = json_decode($value['harga_default'], true)['nofak'];
      if(empty($nofaktol)){
        $nofaktol = $value['id_tr_stokbarang'];
      }  ?>
<div id="modaltransaksiupdatestokbarang<?php echo $nofaktol ?>" class="modal fade" role="dialog"  style="overflow:hidden;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pembayaran Piutang Stok Barang</h4>
      </div>
      <div class="modal-body">
      <div class="col-md-12">
        <form action="javascript:void(0)" method="POST" id="formtransaksiupdate<?php echo $nofaktol ?>">
            <label>Total Pembayaran Piutang</label>
            <input type="text" class="form-control" placeholder="Masukan Jumlah Yang Akan Dibayarkan " name="piutang_deleted_<?php echo $value['id_tr_stokbarang'] ?>" /><br/>
        </form>
        </div><br/>&nbsp;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updatetransaksidatastokbarang<?php echo $nofaktol ?>()">Update Data</button>
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
<?php foreach ($data as $key => $value) { $nofaktol = json_decode($value['harga_default'], true)['nofak'];
      if(empty($nofaktol)){
        $nofaktol = $value['id_tr_stokbarang'];
        $value['piutang'] = array_sum(($variabledata[$nofaktol]['piutang']));
      }?>
function updatetransaksidatastokbarang<?php echo $nofaktol ?>()
  {
    if($("input[name='piutang_deleted_<?php echo $nofaktol ?>']").val().length===0){
      alert("Total Pembayaran Wajib Diisi");
      return false;
    }
    if($("input[name='piutang_deleted_<?php echo $nofaktol ?>']").val() > <?php echo $value['piutang'] ?>){
      alert("Pembayaran Piutang Melebihi Nilai Piutang");
      return false;
    }
    var a = new FormData(document.getElementById("formtransaksiupdate<?php echo $nofaktol ?>"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/updatepiutangfaktur?id='.$nofaktol) ?>",
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