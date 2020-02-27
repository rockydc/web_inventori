<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
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
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.html"><i class="fas fa-box-open"></i><span>Produk</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.html"><i class="fas fa-coins"></i><span>Stock</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.html"><i class="fas fa-layer-group"></i><span>Kategori</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.html"><i class="fas fa-user-tie"></i><span>User</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <div class="button-section">
                            <a class="btn float-right btn-lg" data-toggle="modal" data-target="#myModalAdd" type="button">Tambah</a>
                            <div tabindex="-1" class="modal fade" id="myModalAdd">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h2 class="text-center">Input Data</h2>
                                            <form class="form-inline" enctype="multipart/form-data" method="POST" action="<?= base_url() ?>produk/save" style="padding-top: 33px; padding-bottom: -12px;">
                                                <div class="form-group row" style="  margin-bottom: 10px;width: 464px;">

                                                    <div class="col"><input type="text" name="id_produk" class="form-control" style="width: 100%;" value="<?php echo $idproduk['id_produk']; ?>" readonly /></div>
                                                </div>
                                                <div class="form-group row" style="  margin-bottom: 10px;width: 464px;">
                                                    <div class="col-4"><label class="col-form-label" style="  margin-right: 24px; width: 100%;">Kode Produk</label></div>
                                                    <div class="col"><input type="text" name="kode_produk" class="form-control" style="width: 100%;" value="pdk2020<?php echo sprintf("%03s", $kodeproduk['kode_barang']) ?>" readonly /></div>
                                                </div>
                                                <div class="form-group row" style="  margin-bottom: 10px; width: 464px;">
                                                    <div class="col-4"><label class="col-form-label" style="  margin-right: 24px; width: 100%;">Nama Produk</label></div>
                                                    <div class="col"><input type="text" name="nama_produk" class="form-control" style="  width: 100%;" /></div>
                                                </div>
                                                <div class="form-group row" style="  margin-bottom: 10px;width: 464px;">
                                                    <div class="col-4"><label class="col-form-label" style="  margin-right: 24px;width: 100%;">Kategori</label></div>
                                                    <div class="col">
                                                        <select name="kategori" class="form-control" placeholder="kategori" required>
                                                            <?php foreach ($kategori->result() as $row) : ?>
                                                                <option value="<?php echo $row->id_kategori; ?>"><?php echo $row->nama_kategori; ?></option>
                                                            <?php endforeach; ?>
                                                        </select></div>
                                                </div>
                                                <div class="form-group row" style="  margin-bottom: 10px; width: 464px;">
                                                    <div class="col-4"><label class="col-form-label" style="  margin-right: 24px; width: 100%;">Stok</label></div>
                                                    <div class="col"><input type="text" name="stok" class="form-control" style="  width: 100%" /></div>
                                                </div>
                                                <div class="form-group row" style="  margin-bottom: 10px;width: 464px;">
                                                    <div class="col-4"><label class="col-form-label" style="  margin-right: 24px;width: 100%;">Foto</label></div>
                                                    <div class="col"><input type="file" name="files" /></div>

                                                </div>
                                                <div class="form-group row" style="  margin-bottom: 10px;width: 464px;">
                                                    <div class="col-4"><label class="col-form-label" style="  margin-right: 24px;width: 100%;">Tanggal Register</label></div>
                                                    <div class="col"><input class="form-control" name="tgl_register" type="date" /></div>
                                                </div><button class="btn btn-primary" name="submit" type="submit">Submit</button>
                                                <button class="btn btn-light btn-close" style="background-color:gray!important;color:black;" type="button" data-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><img src="<?= base_url() ?>assets/img/eureka%20(1).png" style="height: 105px;">
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4 table-header">
                        <h2 class="text-dark mb-0">Produk</h2>

                        <div class="d-none d-sm-inline-block">

                            <a class="btn btn-primary btn-sm  print-button" role="button" href=" <?= base_url(); ?>Produk/export_excel"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report As Excel</a>
                            <a class="btn btn-primary btn-sm  print-button" role="button" href=" <?= base_url(); ?>Produk/export_pdf"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report As PDF</a>
                        </div>

                    </div>
                </div>
                <div class="table-responsive section-table container-fluid">
                    <table class="table table-striped table-bordered" style="width:100%" id="table_produk">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Kategori</th>
                                <th>Nama Produk</th>
                                <th>Kode Produk</th>
                                <th>stok</th>
                                <th><strong>foto Produk</strong></th>
                                <th><strong>Tanggal Register</strong></th>
                                <th><strong>Control</strong></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>


            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2019</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="<?= base_url(); ?>datatables.net-bs/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->

    <script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script> -->


    <script src="<?= base_url(); ?>assets/js/theme.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/r-2.2.3/datatables.min.js"></script>

    <script type="text/javascript">
        var tabel = null;

        $(document).ready(function() {
            //datatables
            table = $('#table_produk').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                "order": [
                    [0, 'asc']
                ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax": {
                    "url": '<?php echo site_url('Produk/view'); ?>',
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 50],
                    [5, 10, 50]
                ], // Combobox Limit

                //Set column definition initialisation properties.
                "columns": [{
                        "data": "id_produk",
                        width: 50
                    },
                    {
                        "data": "kategori",
                        width: 50
                    },
                    {
                        "data": "nama_produk",
                        width: 100
                    },
                    {
                        "data": "kode_produk",
                        width: 100
                    },
                    {
                        "data": "stok",
                        width: 100
                    },
                    {
                        "data": "foto_produk",
                        width: 100
                    },
                    {
                        "data": "tgl_register",
                        width: 100
                    },
                    {
                        "render": function(data, type, row) { // Tampilkan kolom aksi
                            var html = "<a class='btn' type='button' style='background-color:#0253A2;color:white' href='<?= base_url(); ?>Produk/hapus/$id_produk'>EDIT</a> | "
                            html += "<a class='btn' type='button' style='background-color:red;color:white'href=''>DELETE</a>"
                            return html
                        },
                        width: 100
                    }
                ],

            });

        });
    </script>

</body>

</html>