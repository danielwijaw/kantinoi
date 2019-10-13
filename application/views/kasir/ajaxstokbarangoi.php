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
                <button data-toggle="modal" data-target="#modalcaricuk" class="btn btn-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
                <button data-toggle="modal" data-target="#modalenambah" class="btn btn-primary btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button>
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
            <button data-dismiss="modal" onclick="selectbarang({reg_stok:'<?php echo $value['reg_stokbarang'] ?>', stok:<?php echo $value['jumlahbarang'] ?>})" class="btn btn-xs btn-warning" title="Select Data"><i class="fa fa-sync-alt" aria-hidden="true"></i></button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<div style="text-align:center">
<?php echo $button ?>
</div>