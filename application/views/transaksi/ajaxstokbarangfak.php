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
    <?php foreach ($variabledata as $key => $value) {
    ?>
    <tr>
        <td><?php echo $key ?></td>
        <td>
          <?php foreach($variabledata[$key]['nama_barang'] as $kontal){
            echo $kontal."<br/>";
          }?>
        </td>
        <td><?php foreach($variabledata[$key]['nama_supplier'] as $kontal){
            echo $kontal."<br/>";
          }?></td>
        <td><?php foreach($variabledata[$key]['jenisbarang'] as $kontal){
            echo $kontal."<br/>";
          }?></td>
        <td>Total :<?php echo rupiah(array_sum(($variabledata[$key]['piutang']))); ?></td>
        <td>
          <a onclick="return confirm('Anda Yakin Akan Membayar Piyutang Suplier?')" href="<?php echo base_url('/mastertr/updatepiutangfaktur?id='.$key) ?>">
            <button class="btn btn-xs btn-warning" title="Pembayaran Piyutang" >
              <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
          </a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<div style="text-align:center">
<?php echo $button ?>
</div>
