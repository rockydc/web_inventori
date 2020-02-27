<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?= $judul; ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/mloureiro1973-login.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/mloureiro1973-login-1.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/r-2.2.3/datatables.min.css" /> <!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion side-bar-section p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">

                    <div class="sidebar-brand-text mx-3"><span>Web inventori</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link active klik_menu" id="Produk" href="<?= base_url(); ?>CrudProduk/"><i class="fas fa-box-open"></i><span>Produk</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active klik_menu" id="kategori" href="<?= base_url(); ?>CrudKategori"><i class="fas fa-layer-group"></i><span>Kategori</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active klik_menu" href="<?= base_url(); ?>CrudStock"><i class="fas fa-coins"></i><span>Stock</span></a></li>

                    <li class="nav-item" role="presentation"><a class="nav-link active" href="<?= base_url() ?>Login/Logout"><i class="fas fa-user-tie"></i><span>Logout</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>