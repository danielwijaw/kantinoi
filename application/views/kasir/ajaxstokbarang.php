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
                <button data-toggle="modal" data-target="#modalcarikasir" class="btn btn-primary btn-xs"><i class="fa fa-search" aria-hidden="true"></i></button>
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
            <button id="stokbarangpalingpol<?php echo $key ?>" data-dismiss="modal" onclick="selectbarang('<?php echo $value['reg_stokbarang'] ?>')" class="btn btn-xs btn-warning hooverwak" title="Select Data"><i class="fa fa-sync-alt" aria-hidden="true"></i>&nbsp;Pilih</button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<div style="text-align:center">
<?php echo $button ?>
</div>

<script>
    $('#stokbarangpalingpol0').focus();
    $("#caribarangkasir").focus();
</script>