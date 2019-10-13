<div class="box box-primary">
    <div class="box-header with-border">
        <table width = "100%">
            <tr>
                <td width="50%"><h3 class="box-title titlealert">Report Rekap Pembelian</h3></td>
                <td width="24%">&nbsp;</td>
                <td width="18%"><input type="text" name="carioyy" id="carioyy" placeholder="Masukan Keyword Pencarian" class="form-control"><input type="text" name="daterekappembelian" id="daterekappembelian" class="form-control"></td>
                <td width="8%">&nbsp;
                    <button class="btn btn-primary btn-sm" onclick="filterpembelian()">
                        <i class="fa fa-filter" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="printpembelian()">
                        <i class="fa fa-print" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
        </table>
    </div>
    <div class="box-body">
        <div class="col-md-12">
            <div class="table-responsive">
                <div id="datapembelian"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $('input[name="daterekappembelian"]').daterangepicker({ 
        locale: {
            format: 'Y-MM-DD'
        }
    });
    function filterpembelian()
    {   
        var tanggal = $('input[name="daterekappembelian"]').val();
        var cari = $('input[name="carioyy"]').val();
        $.ajax({
            url: "<?php echo base_url('/report/transaksipembelianout?date='); ?>"+tanggal+"&cari="+cari,
            type: "GET",
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(data) {
                $("#datapembelian").html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.responseText); 
                if (XMLHttpRequest.status == 0) {
                    alert(' Check Your Network.');
                } else if (XMLHttpRequest.status == 404) {
                    alert('Requested URL not found.');
                } else if (XMLHttpRequest.status == 500) {
                    alert('Internel Server Error.');
                }  else {
                    alert('Unknow Error.\n' + XMLHttpRequest.responseText);
                }     
            }
        });
        
    }

    function printpembelian(){
        var newWindow = window.open("","_blank");
        var tanggal = $('input[name="daterekappembelian"]').val();
        var cari = $('input[name="carioyy"]').val();
        newWindow.location.href = "<?php echo base_url('/report/transaksipembelianout?date='); ?>"+tanggal+"&print=1"+"&cari="+cari;
    }
</script>