<?php error_reporting(0) ?>
<head>
    <title>PRINT OUT KASIR <?php echo $_GET['tanggal'][0]." - ".$_GET['tanggal'][1] ?></title>
    <link rel="stylesheet" href="/style1.min.css">
</head>
<body <?php if($_GET['print']=='1'){ echo 'onload="window.print()"';} ?>>
    <?php if($_GET['print']=='1'){ ?>
    <h2 style="text-align:center">
        Report Transaksi Piutang <?php echo $_GET['tanggal'][0]." - ".$_GET['tanggal'][1] ?>
    </h2>
    <?php } ?>
    <table class="table table-bordered" width="100%">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Stok Awal</th>
            <th>Stok Akhir</th>
            <th>Piutang</th>
            <th>Pembayaran</th>
            <th>Tanggal Piutang</th>
            <th>Tanggal Pembayaran</th>
        </tr>
        <?php foreach($result as $key => $value){ ?>
        <?php $data = json_decode($value['piutang_clear']);
            //print_r($data);
        ?>
        <tr>
            <td><?php echo $key+1 ?></td>
            <td><?php echo $value['stokbarang'] ?></td>
            <td><?php echo $value['stok_awal'] ?></td>
            <td><?php echo $value['stok_perbarui'] ?></td>
            <td><?php echo $value['piutang'] ?></td>
            <td><?php foreach($data as $keyx => $valuex){ echo $valuex."<br/>"; } ?></td>
            <td><?php echo $value['created_at'] ?></td>
            <td><?php foreach($data as $keyx => $valuex){ echo $keyx."<br/>"; } ?></td>
        </tr>
        <?php } ?>
    </table>
</body>