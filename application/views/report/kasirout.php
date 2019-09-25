<?php //print_r($result) ?>
<head>
    <title>PRINT OUT KASIR <?php echo $_GET['tanggal'] ?></title>
    <link rel="stylesheet" href="/style1.min.css">
</head>
<body>
    <table class="table table-bordered" width="100%">
        <tr>
            <th>No</th>
            <th>Nomor Penjualan</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga (Retail || Grosir)</th>
            <th>Harga Penjualan</th>
            <th>Total</th>
            <th>ID Pelanggan</th>
            <th>ID Kasir</th>
            <th>Tanggal Pembayaran</th>
        </tr>
        <?php foreach($result as $key => $value){ ?>
        <tr>
            <td><?php echo $key+1 ?></td>
            <td><?php echo $value['nomor_tr_penjualan'] ?></td>
            <td><?php echo $value['nama_barang'] ?></td>
            <td><?php echo $value['jumlah_barang'] ?> <?php echo $value['satuan'] ?></td>
            <td><?php echo $value['harga_retail'] ?> || <?php echo $value['harga_grosir'] ?></td>
            <td><?php echo $value['harga_fix'] ?></td>
            <td><?php echo ($value['harga_fix']*$value['jumlah_barang']) ?></td>
            <td><?php echo $value['id_pelanggan'] ?></td>
            <td><?php echo $value['created_by'] ?></td>
            <td><?php echo $value['deleted_at'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>