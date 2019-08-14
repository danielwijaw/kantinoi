<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title" id="tanggalnow"></h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
        	<div class="panel-group">
			  <div class="panel panel-primary">
			    <div class="panel-body"><h2>Selamat Datang <?php echo $this->session->userdata('nama') ?></h2></div>
			  </div>
			</div>
        </div>
    </div>
</div>

<script language="JavaScript">
    var tanggallengkap = new String();
    var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
    namahari = namahari.split(" ");
    var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
    namabulan = namabulan.split(" ");
    var tgl = new Date();
    var hari = tgl.getDay();
    var tanggal = tgl.getDate();
    var bulan = tgl.getMonth();
    var tahun = tgl.getFullYear();
    tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;
	$("#tanggalnow").html(tanggallengkap);
</script>