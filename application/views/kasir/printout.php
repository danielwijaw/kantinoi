<head>
    <title>
        PRINTOUT TRANSAKSI <?php echo $_GET['number'] ?>
    </title>
    <style>
        body, table{
            font-family: arial;
            font-size: 10pt;
        }
        .center{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="center">
        TOKO DADI KELUARGA<br/>
        Jl. Sultan Agung No.8A Teluk<br/>
        PURWOKERTO
    </div>
    <hr/>
    <table width="100%">
        <tr>
            <td width="22%">Tgl.</td>
            <td width="1%">:</td>
            <td width="25%"><?php echo date('d/m/Y'); ?></td>
            <td width="3%">&nbsp;</td>
            <td width="25%">Kasir</td>
            <td width="1%">:</td>
            <td width="25%"><?php echo $this->session->userdata('nip') ?> <?php echo $this->session->userdata('nama') ?></td>
        </tr>
        <tr>
            <td>No</td>
            <td>:</td>
            <td><?php echo $_GET['number'] ?></td>
            <td>&nbsp;</td>
            <td>Jam</td>
            <td>:</td>
            <td><?php echo date('H:i') ?></td>
        </tr>
    </table>
    <hr/>
    <table width="100%">
        <?php foreach($data as $key => $value){ ?>
        <tr>
            <td width="70%"><?php echo $value['id_barang'].' '.$value['nama_barang'].'<br/>'.$value['jumlah_barang'].' '.$value['satuan'].' X '.number_format($value['harga_fix']) ?></td>
            <td width="1%">:</td>
            <td width="29%"><?php echo 'Rp. '.number_format($value['jumlah_barang'] * $value['harga_fix']) ?></td>
        </tr>
        <?php } ?>
    </table>
    <table width="100%">
        <tr>
            <td width="70%">TOTAL</td>
            <td width="1%">:</td>
            <td width="29%"><?php echo $_GET['totalmoney'] ?></td>
        </tr>
        <tr>
            <td>JUMLAH UANG</td>
            <td>:</td>
            <td><?php echo $_GET['rupiah'] ?></td>
        </tr>
        <tr>
            <td>KEMBALI</td>
            <td>:</td>
            <td><?php echo $_GET['backmoney'] ?></td>
        </tr>
    </table>
    <hr/>
    <div class="center">
        TERIMA KASIH ATAS<br/>
        KUNJUNGAN DAN BELANJA ANDA
    </div>
</body>