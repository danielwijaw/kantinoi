<link rel="stylesheet" href="/style1.min.css">
<table class="table table-bordered">
    <tr>
        <td>Nomor Faktur</td>
        <td>Nama Barang</td>
        <td>Stok Beli</td>
        <td>Retur Barang</td>
    </tr>
    <?php foreach($result as $key => $value){ 
        $retur = json_decode($value['retur_barang'], true);    
    ?>
    <tr>
        <td><?php echo $_GET['nofak'] ?></td>
        <td><?php echo $value['stokbarang'] ?></td>
        <td><?php echo $value['stok_perbarui'] - $value['stok_awal'] ?></td>
        <td><?php echo $retur['jumlah']."<br/>(".$retur['tanggal'].")"; ?></td>
    </tr>
    <?php } ?>
</table>