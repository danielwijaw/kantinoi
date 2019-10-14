<?php error_reporting(0) ?>
<head>
    <title>Report Transaksi Piutang & Harga Barang <?php echo $_GET['tanggal'][0]." - ".$_GET['tanggal'][1] ?></title>
    <link rel="stylesheet" href="/style1.min.css">
</head>
<body <?php if($_GET['print']=='1'){ echo 'onload="window.print()"';} ?>>
    <?php if($_GET['print']=='1'){ ?>
    <h2 style="text-align:center">
        Report Transaksi Piutang & Harga Barang <?php echo $_GET['tanggal'][0]." - ".$_GET['tanggal'][1] ?>
    </h2>
    <?php } ?>
    <table class="table table-bordered" width="100%">
        <tr>
            <th width="3%">No</th>
			<th>No Faktur</th>
            <th>Nama Barang</th>
            <th>Supplier</th>
            <th>Jumlah Beli</th>
            <th>Harga</th>
            <th>PPN</th>
            <th>Total</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach($result as $key => $value){
            $harga = json_decode($value['harga_default'], true);
        ?>
        <tr>
            <td><?php echo $key+1 ?></td>
			<td><?php echo $harga['nofak'] ?></td>
            <td><?php echo $value['stokbarang'] ?></td>
            <td><?php echo $value['nama_supplier'] ?></td>
            <td><?php echo (int)$value['stok_perbarui']-$value['stok_awal'] ?></td>
            <td><?php echo rupiah($harga['harga_barang']) ?></td>
            <td><?php echo $harga['ppn_barang'] ?> %</td>
            <?php $ttl3[]=($harga['diskon_barang']);?>

			<?php $ttl[]=(($value['stok_perbarui']-$value['stok_awal'])*(($harga['harga_barang']*$harga['ppn_barang']/100)+$harga['harga_barang']));?>
            <td><?php echo rupiah(($value['stok_perbarui']-$value['stok_awal'])*(($harga['harga_barang']*$harga['ppn_barang']/100)+$harga['harga_barang'])); ?></td>
            <?php $ttl2[]=($value['piutang']);?>


            <td><a href="<?php echo base_url('/kasirtr/deletetransaksifaktur/?idbarang='.$value['reg_stokbarang'].'&nofak='.$harga['nofak'].'&id='.$value['id_tr_stokbarang'].'&val='.((int)$value['stok_perbarui']-$value['stok_awal'])) ?>"><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></a></td>
        </tr>
        <?php } ?>
    <tr>
			<td colspan=9>&nbsp;</td>

		</tr>
		<tr>
			<td colspan=6></td>
			<?php $harga1 = array_sum($ttl);?>
			<?php $harga2 = array_sum($ttl2);?>
      <?php $harga3 = array_sum($ttl3);?>
      <?php $total123 = $harga1-$harga3;?>
			<td><b>Sub Total</b></td>
			<td><b><?php echo rupiah($harga1); ?></b></td>
      <td>&nbsp;</td>



		</tr>

    <tr>
			<td colspan=6></td>
			<td><b>Diskon</b></td>
			<td><b><?php echo rupiah($harga3); ?></b></td>
      <td>&nbsp;</td>
		</tr>
    <tr>
			<td colspan=6></td>
			<td><b>Total</b></td>
			<td><b><?php echo rupiah($total123); ?></b></td>
      <td>&nbsp;</td>
		</tr>
    <tr>
			<td colspan=6></td>
			<td><b>Piutang</b></td>
			<td><b><?php echo rupiah($harga2); ?></b></td>
      <td>&nbsp;</td>
		</tr>
    </table>
</body>

<script>
$('input[name="ppn_total"]').val('<?php echo $harga['ppn_barang'] ?>');
$(function()
    {
      $('#utangenongol').change(function()
      {
        if ($(this).is(':checked')) {
          munculduit();
        }else{
          duitenoll();
        };
      });
      $('input[name="jumlah_barang"]').keyup(function(){
        if ($('#utangenongol').is(':checked')) {
          munculduit();
        }else{
          duitenoll();
        };
      });
      $('input[name="total_harga"]').keyup(function(){
        if ($('#utangenongol').is(':checked')) {
          munculduit();
        }else{
          duitenoll();
        };
      });
      $('input[name="ppn_total"]').change(function(){
        var utangetext = Number('<?php echo $total123; ?>');
        if ($('#utangenongol').is(':checked')) {
          munculduit();
        }else{
          duitenoll();
        };
      });
      $('input[name="diskon_total"]').change(function(){
        if ($('#utangenongol').is(':checked')) {
          munculduit();
        }else{
          duitenoll();
        };
      });
    });
function munculduit(){
  var total123 = Number('<?php echo $total123; ?>');
  if(total123===0){
    var total123 = $('input[name="piyutang_total"]').val();
  }else{
    var total123 = Number('<?php echo $total123; ?>');
  }
  var tititt = (Number('<?php echo $harga['ppn_barang'] ?>')*Number('<?php echo $total123; ?>')/100);
  var atasd = Number('<?php echo $total123; ?>')-Number(tititt);
  var ppne = Number($('input[name="ppn_total"]').val()) * Number(total123)/100 ;
  var utang1 = Number(atasd)+Number(ppne);
  var utang2 = Number($('input[name="jumlah_barang"]').val()) * Number($('input[name="total_harga"]').val());
  var diskonecuk = Number($('input[name="diskon_total"]').val());
  $('input[name="piyutang_total"]').val(utang1+utang2-diskonecuk);
}
function duitenoll(){
  var utangetext = $('input[name="piyutang_total"]').val('0');
}
</script>
