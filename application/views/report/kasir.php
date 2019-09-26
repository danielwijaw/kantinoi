<div class="box box-primary">
    <div class="box-header with-border">
        <table width = "100%">
            <tr>
                <td width="50%"><h3 class="box-title titlealert">Report Transaksi Kasir Penjualan</h3></td>
                <td width="24%">&nbsp;</td>
                <td width="18%"><input type="text" name="datetransaksikasir" id="datetransaksikasir" class="form-control"></td>
                <td width="8%">&nbsp;
                    <button class="btn btn-primary btn-sm" onclick="filterkasir()">
                        <i class="fa fa-filter" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="printkasir()">
                        <i class="fa fa-print" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
        </table>
    </div>
    <div class="box-body">
        <div class="col-md-12">
            <div class="table-responsive">
                <div id="datatable"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $('input[name="datetransaksikasir"]').daterangepicker({ 
        locale: {
            format: 'Y-MM-DD'
        }
    });
    function filterkasir()
    {
        var tanggal = $('input[name="datetransaksikasir"]').val();
        $.ajax({
            url: "<?php echo base_url('/report/transaksikasirout?date='); ?>"+tanggal,
            type: "GET",
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(data) {
                $("#datatable").html(data);
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

    function printkasir(){
        var newWindow = window.open("","_blank");
        var tanggal = $('input[name="datetransaksikasir"]').val();
        newWindow.location.href = "<?php echo base_url('/report/transaksikasirout?date='); ?>"+tanggal+"&print=1";
    }
</script>