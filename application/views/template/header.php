<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title class="titlealert"><?php echo $this->session->set_name_aps['setting_val']; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/dist/css/skins/select2.min.css">
  <script src="<?php echo base_url('assets/') ?>/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>/bower_components/jquery/dist/select2.full.min.js"></script>
  <style>
    .dropdown-submenu {
      position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
      top: 0;
      left: 100%;
      margin-top: -6px;
      margin-left: -1px;
      -webkit-border-radius: 0 6px 6px 6px;
      -moz-border-radius: 0 6px 6px;
      border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
      display: block;
    }

    .dropdown-submenu>a:after {
      display: block;
      content: " ";
      float: right;
      width: 0;
      height: 0;
      border-color: transparent;
      border-style: solid;
      border-width: 5px 0 5px 5px;
      border-left-color: #ccc;
      margin-top: 5px;
      margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
      border-left-color: #fff;
    }
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url() ?>" class="navbar-brand"><b><?php echo $this->session->set_name_aps['setting_val']; ?></b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="javascript:void()" class="dropdown-toggle" data-toggle="dropdown">Master Data <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a id="<?php echo "master-datasupplier" ?>" href="<?php echo base_url("master/datasupplier") ?>?" onclick="hyperlinkajax(event, this.id)">Master Data Supplier</a></li>
                <li><a id="<?php echo "master-jenisbarang" ?>" href="<?php echo base_url("master/jenisbarang") ?>?" onclick="hyperlinkajax(event, this.id)">Master Jenis Barang / Departemen</a></li>
                <li><a id="<?php echo "master-stokbarang" ?>" href="<?php echo base_url("master/stokbarang") ?>?" onclick="hyperlinkajax(event, this.id)">Master Data Stok Barang</a></li>
                <li><a id="<?php echo "master-hargabarang" ?>" href="<?php echo base_url("master/hargabarang") ?>?" onclick="hyperlinkajax(event, this.id)">Master Data Harga Barang</a></li>
                <li><a id="<?php echo "master-datapelanggan" ?>" href="<?php echo base_url("master/datapelanggan") ?>?" onclick="hyperlinkajax(event, this.id)">Master Data Pelanggan</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="javascript:void()" class="dropdown-toggle" data-toggle="dropdown">Report <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="dropdown-submenu">
                  <a href="javascript:void(0)">Report Master Data</a>
                  <ul class="dropdown-menu">
                    <li><a id="<?php echo "report-master-stokbarang" ?>" href="<?php echo base_url("report/masterstokbarang") ?>?" onclick="hyperlinkajax(event, this.id)">Report Master Stok Barang</a></li>
                    <li><a id="<?php echo "report-master-datadepartemen" ?>" href="<?php echo base_url("report/masterdatadepartemen") ?>?" onclick="hyperlinkajax(event, this.id)">Report Master Data Departemen</a></li>
                    <li><a id="<?php echo "report-master-datasupplier" ?>" href="<?php echo base_url("report/masterdatasupplier") ?>?" onclick="hyperlinkajax(event, this.id)">Report Master Data Supplier</a></li>
                    <li><a id="<?php echo "report-master-datapelanggan" ?>" href="<?php echo base_url("report/masterdatapelanggan") ?>?" onclick="hyperlinkajax(event, this.id)">Report Master Data Pelanggan</a></li>
                  </ul>
                </li>
                <li class="dropdown-submenu">
                  <a href="javascript:void(0)">Report Transaksi</a>
                  <ul class="dropdown-menu">
                    <li><a id="<?php echo "report-transaksi-kasirretail" ?>" href="<?php echo base_url("report/transaksikasirretail") ?>?" onclick="hyperlinkajax(event, this.id)">Report Transaksi Kasir Retail</a></li>
                    <li><a id="<?php echo "report-transaksi-kasirgrosir" ?>" href="<?php echo base_url("report/transaksikasirgrosir") ?>?" onclick="hyperlinkajax(event, this.id)">Report Transaksi Kasir Grosir</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="javascript:void()" class="dropdown-toggle" data-toggle="dropdown">Utility <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a id="<?php echo "utility-hakakses" ?>" href="<?php echo base_url("utility/hakakses") ?>?" onclick="hyperlinkajax(event, this.id)">Hak Akses User</a></li>
                <li><a id="<?php echo "utility-refreshsession" ?>" href="<?php echo base_url("utility/refreshsession") ?>?" onclick="hyperlinkajax(event, this.id)">Refresh Session</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="javascript:void()" class="dropdown-toggle" data-toggle="dropdown">Kasir <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a id="<?php echo "kasir-grosir" ?>" href="<?php echo base_url("kasir/grosir") ?>?" onclick="hyperlinkajax(event, this.id)">Kasir Grosir</a></li>
                <li><a id="<?php echo "kasir-retail" ?>" href="<?php echo base_url("kasir/retail") ?>?" onclick="hyperlinkajax(event, this.id)">Kasir Retail</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu" id="suratdepan"> </li>
            <!-- /.messages-menu -->

            
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url('assets/') ?>/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $this->session->userdata('nama') ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo base_url('assets/') ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                  <p><?php echo $this->session->userdata('nama') ?></p>
                </li>
                <!-- Menu Footer-->
                <li class="user-body">
                  <div class="pull-right">
                    <a href="<?php echo base_url('/login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <section class="content">
        <!-- CONTENT -->
        <div id="dataajax">
  