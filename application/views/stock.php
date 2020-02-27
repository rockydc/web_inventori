<div class="d-flex flex-column badan" id="content-wrapper">
    <div id="content">
        <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
            <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                <div class="button-section">
                    <!-- <a class="btn float-right btn-lg" data-toggle="modal" data-target="#myModalAdd" type="button">Tambah</a> -->
                    <div tabindex="-1" class="modal fade" id="myModalAdd">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h2 class="text-center">Input Data</h2>
                                    <form class="form-inline" enctype="multipart/form-data" method="POST" action="<?= base_url() ?>CrudKategori/insert_kategori" style="padding-top: 33px; padding-bottom: -12px;">
                                        <div class="form-group row" style="  margin-bottom: 10px;width: 464px;">

                                            <div class="col"><input type="text" name="id_produk" class="form-control" style="width: 100%;" name="id_produk" /></div>
                                        </div>
                                        <div class="form-group row" style="  margin-bottom: 10px;width: 464px;">
                                            <div class="col-4"><label class="col-form-label" style="  margin-right: 24px; width: 100%;">Nama Kategori</label></div>
                                            <div class="col"><input type="text" name="Nama_Kategori" placeholder="nama kategori" class="form-control" style="width: 100%;" /></div>
                                        </div>
                                        <button class="btn btn-primary" name="submit" type="submit">Submit</button>
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
                <h2 class="text-dark mb-0">Stok Master</h2>

                <div class="d-none d-sm-inline-block">

                    <a class="btn btn-primary btn-sm  print-button" role="button" href=" <?= base_url(); ?>CrudStock/export_excel"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report As Excel</a>
                    <a class="btn btn-primary btn-sm  print-button" role="button" href=" <?= base_url(); ?>CrudStock/export_pdf"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report As PDF</a>
                </div>

            </div>
        </div>
        <div class="table-responsive section-table container-fluid">
            <table class="table table-striped table-bordered" style="width:100%" id="mytable">
                <thead>
                    <tr>

                        <th>Id Stock</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th> jumlah barang</th>
                        <th>Tanggal Update</th>
                        <!-- <th> Kontrol</th> -->
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>

    <div tabindex="-1" class="modal fade" id="ModalUpdate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="text-center">Update</h2>
                    <form class="form-inline" enctype="multipart/form-data" method="POST" action="<?= base_url() ?>CrudKategori/edit" style="padding-top: 33px; padding-bottom: -12px;">
                        <div class="form-group row" style="  margin-bottom: 10px;width: 464px;">

                            <div class="col"><input type="text" class="form-control" style="width: 100%;" name="id_kategori" readonly /></div>
                        </div>

                        <div class="form-group row" style="  margin-bottom: 10px; width: 464px;">
                            <div class="col-4"><label class="col-form-label" style="  margin-right: 24px; width: 100%;">Nama Kategori</label></div>
                            <div class="col"><input type="text" name="nama_kategori" class="form-control" style="  width: 100%;" /></div>
                        </div>
                        <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                        <button class="btn btn-light btn-close" style="background-color:gray!important;color:black;" type="button" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form id="add-row-form" action="<?php echo site_url('CrudKategori/delete_kategori'); ?>" method="post">
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" id="myModalLabel">Delete Product</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_kategori" class="form-control" required>
                        <strong>yakin ingin menghapus data?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-success">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


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

<script>
    $(document).ready(function() {
        // Setup datatables
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var table = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                    .off('.DT')
                    .on('input.DT', function() {
                        api.search(this.value).draw();
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            "deferRender": true,
            "aLengthMenu": [
                [5, 10, 50],
                [5, 10, 50]
            ], // Combobox Limit

            ajax: {
                "url": "<?php echo base_url() . 'index.php/CrudStock/getjson' ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "id_stock",
                    width: 30
                },
                {
                    "data": "kode_produk",
                    width: 80
                },
                {
                    "data": "nama_produk",
                    width: 80
                },
                {
                    "data": "jumlah_barang",
                    width: 80
                },
                {
                    "data": "tgl_update",
                    width: 80
                }
                // {
                //     "data": "view",
                //     width: 20
                // }
            ],
            order: [
                [1, 'asc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                $('td:eq(0)', row).html();
            }

        });


        // end setup datatables
        // get Edit Records
        // $('#mytable').on('click', '.edit_record', function() {
        //     var code = $(this).data('code');
        //     var name = $(this).data('name');

        //     $('#ModalUpdate').modal('show');
        //     $('[name="id_kategori"]').val(code);
        //     $('[name="nama_kategori"]').val(name);



        // });
        // // End Edit Records
        // // get delete Records
        // $('#mytable').on('click', '.delete_record', function() {
        //     var code = $(this).data('code');
        //     $('#ModalDelete').modal('show');
        //     $('[name="id_kategori"]').val(code);
        // });
        // End delete Records
    });
</script>