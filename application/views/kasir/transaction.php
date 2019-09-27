<style>
    td {
        valign : top;
    }
</style>
<div>
    <?php error_reporting(0); if(isset($transaction[0])){ ?>
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
    <?php foreach($transaction as $key => $value){ 
      $duit[] = $value['jumlah'];  
    ?>
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
        <input type="hidden" name="methodpayment" id="methodpayment" value="tunai">
        <label>Total Belanja</label>
        <input type="text" name="totalmoney" class="form-control" readonly=readonly value="<?php echo 'Rp. '.number_format(array_sum($duit)); ?>"><br/>
        <label>Jumlah Uang Diterima</label>
        <input type="text" name="getmoney" id="rupiah" class="form-control"><br/>
        <label>Kembalian</label>
        <input type="text" name="backmoney" id="backmoney" readonly=readonly class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="paymenttransaction('<?php echo $_GET['number_transaction'] ?>')">Bayar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		var backmoney = document.getElementById('backmoney');
		rupiah.addEventListener('keyup', function(e){
			rupiah.value = formatRupiah(this.value, 'Rp. ');
      kembalian();
      backmoney.value = formatRupiah(backmoney.value, 'Rp. ');
		});

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
      if(angka.charAt(0)=='-'){
        var olrait = "-";
      }else{
        var olrait = "";
      }

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? olrait+'Rp. ' + rupiah : '');
		}
    function kembalian()
    {
      var total = '<?php echo array_sum($duit) ?>';
      var money = $('#rupiah').val();
      var fixmoney = money.split('Rp. ');
      var realfix = fixmoney[1].replace(".","");
      var yakinfix = realfix.replace(".","");
      var jujulan = yakinfix - total;
      $("#backmoney").val(jujulan);
    }
	</script>