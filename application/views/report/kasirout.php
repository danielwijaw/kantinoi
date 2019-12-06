<?php error_reporting(0);?>
<head>
    <title>PRINT OUT KASIR <?php echo $_GET['tanggal'][0]." - ".$_GET['tanggal'][1] ?></title>
    <link rel="stylesheet" href="/style1.min.css">
    <script src="/jquery/dist/jquery.min.js"></script>
</head>
<?php if($_GET['pilihankasir']==0){ ?>
<body <?php if($_GET['print']=='1'){ echo 'onload="window.print()"';} ?>>
    <?php if($_GET['print']=='1'){ ?>
    <h2 style="text-align:center">
        Report Transaksi Kasir <?php echo $_GET['tanggal'][0]." - ".$_GET['tanggal'][1] ?>
    </h2>
    <?php } ?>
        <input type="hidden" id="jumlah_baru_print" value="0">
        <input type="hidden" id="jumlahprovitcuk" value="0">
    <table class="table table-bordered" width="100%">
        <tr>
            <th>No</th>
			<th>Tanggal Pembayaran</th>
            <th>Nomor Penjualan</th>
			<th>ID Pelanggan</th>
            <th>ID Kasir</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga (Retail || Grosir)</th>
            <th>Harga Penjualan</th>
            <th>Total</th>
            <th>Harga Beli</th>
            <th>Provit</th>
        </tr>
        <?php foreach($result as $key => $value){ $harga = json_decode($value['harga_default'], true); ?>
        <?php 
            $harga_beli = (int)(($harga['harga_barang']*$harga['jumlah_barang']) - $harga['diskon_barang'] + ($harga['jumlah_barang']*($harga['harga_barang']*$harga['ppn_barang']/100))) / $harga['jumlah_barang'];    
            $batine = (int)($harga_beli*$value['jumlah_barang'])-$value['harga_fix']*$value['jumlah_barang'];
            $ngitungbati[] = $batine;
        ?>
        <tr>
            <td><?php echo $key+1 ?></td>
			<td><?php echo $value['deleted_at'] ?></td>
            <td><?php echo $value['nomor_tr_penjualan'] ?></td>
			<td><?php echo $value['id_pelanggan'] ?></td>
            <td><?php echo $value['created_by'] ?></td>
            <td><?php echo $value['nama_barang'] ?></td>
            <td><?php echo $value['jumlah_barang'] ?> <?php echo $value['satuan'] ?></td>
            <td><?php echo rupiah($value['harga_retail']) ?> <br/> <?php echo rupiah($value['harga_grosir']) ?></td>
            <td><?php echo rupiah($value['harga_fix']) ?></td>
			<?php $ttl[]=($value['harga_fix']*$value['jumlah_barang']);?>
            <td><?php echo rupiah($value['harga_fix']*$value['jumlah_barang']) ?></td>
            <td><?php echo rupiah($harga_beli); ?></td>
            <td><?php echo rupiah($batine) ?></td>
        </tr>
        <?php } ?>
		<tr>
			<td colspan=8></td>
			<?php $harga = array_sum($ttl);?>
			<td><b>Total</b></td>
			<td><b><?php echo rupiah($harga); ?></b></td>
            <td></td>
            <td><?php echo rupiah(array_sum($ngitungbati)); ?></td>
		</tr>
    </table>
</body>
<?php }else{ ?>
<?php 
    foreach($result as $key => $value){
        $harga = json_decode($value['harga_default'], true); 
        $harga_beli = (int)(($harga['harga_barang']*$harga['jumlah_barang']) - $harga['diskon_barang'] + ($harga['jumlah_barang']*($harga['harga_barang']*$harga['ppn_barang']/100))) / $harga['jumlah_barang'];   
        $metune[$value['created_by']]['pendapatan'][] = (int)$value['harga_fix']*$value['jumlah_barang'];
        $metune[$value['created_by']]['harga_beli'][] = $harga_beli;
        $metune[$value['created_by']]['provit'][] = (int)($harga_beli*$value['jumlah_barang'])-$value['harga_fix']*$value['jumlah_barang'];
    };
?>
<body <?php if($_GET['print']=='1'){ echo 'onload="window.print()"';} ?>>
    <?php if($_GET['print']=='1'){ ?>
    <h2 style="text-align:center">
        Report Transaksi Kasir Per Admin <?php echo $_GET['tanggal'][0]." - ".$_GET['tanggal'][1] ?>
    </h2>
    <?php } ?>
        <input type="hidden" id="jumlah_baru_print" value="0">
        <input type="hidden" id="jumlahprovitcuk" value="0">
    <table class="table table-bordered" width="100%">
        <tr>
            <td>No</td>
            <td>Kasir</td>
            <td>Pendapatan</td>
            <td>Provit</td>
        </tr>
        <?php 
            $query = $this->db->query("SELECT * FROM tm_user");
            $asdasdsaxc = $query->result_array();
            $asdasd = 1;
            foreach($asdasdsaxc as $ker => $asdcno){
        ?>
        <tr>
            <td><?php echo $asdasd++ ?></td>
            <td><?php echo $asdcno['nama'] ?></td>
            <td><?php echo rupiah(array_sum($metune[$asdcno['nip']]['pendapatan'])) ?></td>
            <td><?php echo rupiah(array_sum($metune[$asdcno['nip']]['provit'])) ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
<?php } ?>