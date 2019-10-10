<table class="table table-bordered">
    <thead>
        <tr>
            <th width="15%">ID Transaksi</th>
            <th>Tanggal</th>
            <td width="7%"></td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $value) { ?>
    <tr>
        <td><?php echo $value['nomor_tr_penjualan'] ?></td>
        <td><?php echo $value['deleted_at'] ?></td>
        <td>
            <a onclick="return confirm('Anda Yakin Akan Menghapus Transaksi Penjualan?')" href="<?php echo base_url('/transaksiC/hapusdatatransaksi?id='.$value['nomor_tr_penjualan']) ?>">
              <button class="btn btn-xs btn-danger" title="Hapus Data">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </button>
            </a>
            <a target="_blank" href="<?php echo base_url('/kasir/printout?number='.$value['nomor_tr_penjualan']) ?>">
              <button class="btn btn-xs btn-warning" title="Lihat Data">
                <i class="fa fa-eye" aria-hidden="true"></i>
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