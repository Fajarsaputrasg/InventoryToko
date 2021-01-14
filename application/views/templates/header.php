<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php if(isset($title)){ echo $title; } ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/css/fonts-googleapis.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
    .wrapping-choice{
      word-wrap: break-word;min-width: 160px;max-width: 160px;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-fw fa-box"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: 12px;">Inventory Keramik Jakarta</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item <?php if(isset($daftarbarangmenu)){ echo $daftarbarangmenu; } ?>">
        <a class="nav-link" href="<?php echo base_url()?>barang">
          <i class="fas fa-fw fa-list"></i>
          <span>Daftar Barang</span></a>
      </li>

      <?php if($_SESSION["role"] == "1"){ ?>
      <li class="nav-item <?php if(isset($usermanagementmenu)){ echo $usermanagementmenu; } ?>">
        <a class="nav-link" href="<?php echo base_url()?>usermanagement">
          <i class="fas fa-fw fa-users"></i>
          <span>Users Management</span></a>
      </li>
      <?php }?>

      <li class="nav-item <?php if(isset($inputbarangmenu)){ echo $inputbarangmenu; } ?>">
        <a class="nav-link" href="<?php echo base_url()?>barang/inputbarang">
          <i class="fas fa-fw fa-arrow-right"></i>
          <span>Input Barang</span></a>
      </li>

      <li class="nav-item <?php if(isset($barangkeluarmenu)){ echo $barangkeluarmenu; } ?>">
        <a class="nav-link" href="<?php echo base_url()?>barang/barangkeluar">
          <i class="fas fa-fw fa-arrow-left"></i>
          <span>Barang Keluar</span></a>
      </li>
<!-- 
      <li class="nav-item <?php if(isset($hapusbarangmenu)){ echo $hapusbarangmenu; } ?>">
        <a class="nav-link" href="<?php echo base_url()?>barang/hapusbarang">
          <i class="fas fa-fw fa-fire"></i>
          <span>Hapus Barang</span></a>
      </li> -->

      <li class="nav-item <?php if(isset($laporan)){ echo $laporan; } ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-edit"></i>
          <span>Laporan Keluar Masuk</span>
        </a>
        <div id="collapseTwo" class="collapse <?php if(isset($show)){ echo $show; } ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
            <a class="collapse-item <?php if(isset($laporankeluar)){ echo $laporankeluar; } ?>" href="<?php echo base_url(); ?>laporan/laporan_keluar">Laporan Keluar</a>
            <a class="collapse-item <?php if(isset($laporanmasuk)){ echo $laporanmasuk; } ?>" href="<?php echo base_url(); ?>laporan/laporan_masuk">Laporan Masuk</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nama']; ?></span>
                <img class="img-profile rounded-circle" src="<?php echo base_url(); ?>assets/img/user.png" style="width: 25px; height: 25px;">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo base_url()."log/logout"?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->