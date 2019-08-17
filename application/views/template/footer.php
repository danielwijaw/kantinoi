
        </div>
      </section>
    </div>
  </div>
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> <?php echo $this->session->set_version_aps['setting_val']; ?>
      </div>
      <strong>Copyright By <?php echo $this->session->set_copyright['setting_val']; ?>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<script src="<?php echo base_url('assets/') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    $(".menunya").click(function() {
        $(".menunya").attr('class', 'menunya');
        $(this).attr('class', 'menunya active');
    });

    function hyperlinkajax(e, id) {
        $('#dataajax').html("LOADING .......");
        e.preventDefault();
        var urlxz = $("#"+id+"").attr('href');
        var urlxx = urlxz.split("?");
        var url = urlxx[0];
        $.ajax({
            url: urlxz+"&ajax=true",
            contentType: false,
            cache: true,
            processData: false,
            success: function(data) {
              $('#dataajax').html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              $('#dataajax').html("ERROR :(");
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
        window.history.pushState({href: url}, '', url);
    }

    function hyperlinkajaxz(url) {
        $('#dataajax').html("LOADING .......");
        $(".menunya active").attr('class', 'menunya');
        $.ajax({
            url: url+"?&ajax='true'",
            contentType: false,
            cache: true,
            processData: false,
            success: function(data) {
                $('#dataajax').html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              $('#dataajax').html("ERROR :(");
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

    $(document).ready(function() {
        $(window).on('popstate', function() {
          hyperlinkajaxz(window.location.href)
        });
    });
</script>
</body>
</html>