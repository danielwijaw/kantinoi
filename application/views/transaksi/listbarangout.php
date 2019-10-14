<table class="table table-bordered">
    <tr>
        <td>Nomor Faktur</td>
        <td>Nama Barang</td>
        <td>Stok Beli</td>
        <td>Retur Barang</td>
        <td>&nbsp;</td>
    </tr>
    <?php foreach($result as $key => $value){ 
        $retur = json_decode($value['retur_barang'], true);    
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
        <td>
            <button data-toggle="modal" onclick="modaloutbarangnya('<?php echo $value['id_tr_stokbarang'] ?>')" data-target="#modaloutbarang" class="btn btn-primary btn-xs">
                <i class="fa fa-check" aria-hidden="true"></i>
            </button>
        </td>
    </tr>
    <?php } ?>
</table>