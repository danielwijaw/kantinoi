<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Master Data Supplier</h3>
    </div>
    <div class="box-body">
        <div class="col-md-12">
        	<div class="table-responsive" id="mastersupplierajax">
                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalsupplier" class="modal fade" role="dialog" style="overflow:hidden;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data Master Supplier</h4>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0)" method="POST" id="formdatasupplier">
        <div class="col-md-12">
            <label>Nama Supplier</label>
            <input type="text" class="form-control" placeholder="Masukan Nama Perusahaan Supplier , Ex = PT Supplier Indonesia " name="nama_supplier" /><br/>
            <label>Atas Nama Supplier</label>
            <input type="text" class="form-control" placeholder="Masukan Atas Nama Supplier, Ex = Susanto Wardoyo" name="atas_nama" /><br/>
            <label>Kontak Atas Nama Supplier</label>
            <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" class="form-control" placeholder="Masukan Kontak Atas Nama Supplier, Ex = 0822673893790" name="kontak_nama" /><br/>
            <label>Alamat Supplier</label>
            <input type="text" class="form-control" placeholder="Masukan Alamat Supplier, Ex = Gang Sanggar RT. 04 RW. 01" name="alamat_supplier" /><br/>
            <label>Kelurahan, Kecamatan, Provinsi Supplier</label>
            <select class="js-data-example-ajax form-control" width="100%" name="kelurahan_supplier" id="kelurahan_supplier">
              
            </select>
        </div><br/>&nbsp;
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="tambahdatasupplier()">Tambah Data</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modalsuppliercari" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cari Data Supplier</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-9">
            <input type="text" id="pencariansupplier" class="form-control" placeholder="Masukan Key Pencarian Supplier">
        </div>
        <div class="col-md-3"><button class="btn btn-primary btn-sm" onclick="carisupplier()">Cari</button></div>
      </div>
      <div class="modal-footer">
        &nbsp;
      </div>
    </div>

  </div>
</div>

<script>
    loaddatastokbarang();
    function loaddatastokbarang()
    {
        $( "#mastersupplierajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/masterajax/supplier') ?>",
        success: function(data) {
            $('#mastersupplierajax').html(data);        
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
    $('.js-data-example-ajax').select2({
           minimumInputLength: 3,
           allowClear: true,
           placeholder: 'Masukan Nama Kelurahan / Kecamatan / Kabupaten / Provinsi',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url('/attribute/getkelurahan') ?>',
              delay: 800,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function (data, page) {
              return {
                results: data
              };
            },
          }
      });
  function tambahdatasupplier()
  {
    if($("input[name='nama_supplier']").val().length===0){
      alert("Nama Supplier Wajib Diisi");
      return false;
    }
    if($("input[name='atas_nama']").val().length===0){
      alert("Atas Nama Supplier Wajib Diisi");
      return false;
    }
    if($("input[name='kontak_nama']").val().length===0){
      alert("Kontak Atas Nama Wajib Diisi");
      return false;
    }
    if($("input[name='alamat_supplier']").val().length===0){
      alert("Alamat Supplier Wajib Diisi");
      return false;
    }
    if(null==$("#kelurahan_supplier").val()){
      alert("Pilihan Kelurahan Supplier Diisi");
      return false;
    }
    var a = new FormData(document.getElementById("formdatasupplier"));
      $.ajax({
        url: "<?php echo base_url('/mastertr/insertdatasupplier') ?>",
        type: "POST",
        data: a,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data) {
          if(data == "Berhasil"){
            alert("Berhasil Input Data Supplier");
            window.location.reload(true);
            return false;
          }else{
            alert(data);
          }
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

  function carisupplier(){
    var pencarian = $("#pencariansupplier").val();
    $( "#mastersupplierajax" ).html( "LOADING....." );
        $.ajax({
        url: "<?php echo base_url('/masterajax/supplier/?cari=') ?>"+pencarian,
        success: function(data) {
            $('#mastersupplierajax').html(data);        
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
</script>