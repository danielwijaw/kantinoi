<link rel="stylesheet" href="/style1.min.css">
<?php 
    $asdsadxzc = json_decode($result[0]['harga_default'], true);
?>
<center><h3><?php error_reporting(0);if($_GET['kiekey']=='piutang'){ echo "Pembayaran Piutang Barang"; }else{ echo "Retur Barang";  } ?></h3></center>
<table class="table" style="border:0">
    <tr>
        <td width="15%">Nomor Faktur</td>
        <td width="3%">:</td>
        <td width="82%"><?php echo $_GET['nofak'] ?></td>
    </tr>
    <tr>
        <td>Tanggal Faktur</td>
        <td>:</td>
        <td><?php echo $asdsadxzc['tanggal'] ?></td>
    </tr>
    <tr>
        <td>Tanggal Bayar</td>
        <td>:</td>
        <td><?php echo date('Y:m:d H:i:s') ?></td>
    </tr>
</table>
<table class="table table-bordered">
    <tr>
        <td>Nomor Faktur</td>
        <td>Nama Barang</td>
        <td>Stok Beli</td>
        <td>Retur Barang</td>
        <td>PPN</td>
        <td>Total</td>
    </tr>
    <?php foreach($result as $key => $value){ 
        $retur = json_decode($value['retur_barang'], true);    
        $harga = json_decode($value['harga_default'], true);
    ?>
    <tr>
        <td><?php echo $_GET['nofak'] ?></td>
        <td><?php echo $value['stokbarang'] ?></td>
        <td><?php echo $value['stok_perbarui'] - $value['stok_awal'] ?></td>
        <td>
            <?php error_reporting(0); foreach($retur as $returkey => $returval){ ?>
                <p><?php echo $returkey ?> (<?php echo $returval['jumlah'] ?>)</p>
            <?php } ?>
        </td>
        <td><?php echo $harga['ppn_barang'] ?> %</td>
        <?php $ttl3[]=($harga['diskon_barang']);?>

        <?php $ttl[]=(($value['stok_perbarui']-$value['stok_awal'])*(($harga['harga_barang']*$harga['ppn_barang']/100)+$harga['harga_barang']));?>
        <td><?php echo rupiah(($value['stok_perbarui']-$value['stok_awal'])*(($harga['harga_barang']*$harga['ppn_barang']/100)+$harga['harga_barang'])); ?></td>
        <?php $ttl2[]=($value['piutang']);?>
    </tr>
    <?php } ?>
    <tr>
			<td colspan=4></td>
			<?php $harga1 = array_sum($ttl);?>
			<?php $harga2 = array_sum($ttl2);?>
            <?php $harga3 = array_sum($ttl3);?>
            <?php $total123 = $harga1-$harga3;?>
			<td><b>Sub Total</b></td>
			<td><b><?php echo rupiah($harga1); ?></b></td>
            <td>&nbsp;</td>
	</tr>

    <tr>
			<td colspan=4></td>
			<td><b>Diskon</b></td>
			<td><b><?php echo rupiah($harga3); ?></b></td>
      <td>&nbsp;</td>
		</tr>
    <tr>
			<td colspan=4></td>
			<td><b>Total</b></td>
			<td><b><?php echo rupiah($total123); ?></b></td>
      <td>&nbsp;</td>
		</tr>
    <tr>
			<td colspan=4></td>
			<td><b>Piutang</b></td>
			<td><b><?php echo rupiah($harga2); ?></b></td>
      <td>&nbsp;</td>
		</tr>
</table>