<style>
    td {
        valign : top;
    }
</style>
<div>
    <?php if(isset($transaction[0])){ ?>
    <label>ID PELANGGAN = <?php echo $transaction[0]['id_pelanggan'] ?></label>
    <?php } ?>
</div>
<table class="table table-bordered" width="100%">
    <tr>
        <td width="5%" style="text-align:center">No</td>
        <td width="65%">Nama Barang</td>
        <td width="12.5%">Harga</td>
        <td width="7.5%">Qty</td>
        <td width="15%">Jumlah</td>
        <td width="5%"><button type="button" class="btn btn-xs btn-danger" onclick="deletedtransaction('<?php echo $_GET['number_transaction'] ?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
    </tr>
    <?php foreach($transaction as $key => $value){ ?>
    <tr>
        <td style="text-align:center"><?php echo $value['no'] ?></td>
        <td><?php echo $value['nama_barang'] ?></td>
        <td><?php echo 'Rp. '.number_format($value['harga_fix']) ?></td>
        <td><?php echo $value['jumlah_barang'].' '.$value['satuan']; ?></td>
        <td><?php echo 'Rp. '.number_format($value['jumlah']); ?></td>
        <td><button type="button" class="btn btn-xs btn-warning" onclick="deleteditemkasir('<?php echo $value['id_tr_penjualan'] ?>', '<?php echo $value['nama_barang'] ?>', '<?php echo $value['id_barang'] ?>', '<?php echo $value['created_at'] ?>', '<?php echo $value['jumlah_barang'] ?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
    </tr>
    <?php } ?>
</table>

<div id="paymenttransaction" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pembayaran Transaksi Penjualan #<?php echo $_GET['number_transaction'] ?></h4>
      </div>
      <div class="modal-body">
        <label>Metode Pembayaran</label>
        <select name="methodpayment" id="methodpayment" class="form-control">
            <option value="tunai">Tunai</option>
            <option value="hutang">Hutang</option>
        </select><br/>
        <label>Total Belanja</label>
        <input type="text" name="totalmoney" class="form-control" required=required><br/>
        <label>Jumlah Uang Diterima</label>
        <input type="text" name="getmoney" class="form-control"><br/>
        <label>Kembalian</label>
        <input type="text" name="backmoney" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Bayar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>