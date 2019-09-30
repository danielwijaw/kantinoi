<?php error_reporting(0) ?>
<head>
    <title>Report Transaksi Piutang & Harga Barang <?php echo $_GET['tanggal'][0]." - ".$_GET['tanggal'][1] ?></title>
    <link rel="stylesheet" href="/style1.min.css">
</head>
<body <?php if($_GET['print']=='1'){ echo 'onload="window.print()"';} ?>>
    <?php if($_GET['print']=='1'){ ?>
    <h2 style="text-align:center">
        Report Transaksi Piutang & Harga Barang <?php echo $_GET['tanggal'][0]." - ".$_GET['tanggal'][1] ?>
    </h2>
    <?php } ?>
    <table class="table table-bordered" width="100%">
        <tr>
            <th width="3%">No</th>
            <th>Nama Barang</th>
            <th width="8.5%">Stok Awal</th>
            <th width="8.5%">Stok Akhir</th>
            <th style="display:none" width="7.5%">Piutang</th>
            <th>Pembayaran</th>
            <th>Tanggal Piutang</th>
            <th>Tanggal Pembayaran</th>
        </tr>
        <?php foreach($result as $key => $value){ ?>
        <?php 
            $display = "";
            $data = json_decode($value['piutang_clear']);
            $harga = json_decode($value['harga_default'], true);
            //print_r($data);
            if($value['piutang']=='0' and $value['piutang_clear']==''){
                $data = array( $value['created_at'] => "<b>Lunas</b>" );
            }
            if($value['harga_default']==''){
                $data = array( $value['created_at'] => "<b>Stok Opname</b>" );
                $display = "display:none";
            }
        ?>
        <tr>
            <td><?php echo $key+1 ?></td>
            <td><?php echo $value['stokbarang'] ?></td>
            <td><?php echo $value['stok_awal'] ?></td>
            <td><?php echo $value['stok_perbarui'] ?></td>
            <td style="display:none"><?php echo rupiah($value['piutang']) ?></td>
            <td><?php foreach($data as $keyx => $valuex){ echo $valuex."<br/>"; } ?></td>
            <td><?php echo $value['created_at'] ?></td>
            <td><?php foreach($data as $keyx => $valuex){ echo $keyx."<br/>"; } ?></td>
        </tr>
        <?php } ?>
    </table>
</body>