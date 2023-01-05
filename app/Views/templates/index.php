<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">

    <!-- Autocomplete -->
    <script src="<?= base_url(); ?>/vendor/autocomplete.js"></script>

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

    <style>
        ul.pagination li a {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #dedede;
            border-radius: 6px;
            margin-right: 2px;
        }

        ul.pagination li a:hover {
            background-color: #4aaff8;
            color: #fff;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= $this->include('templates/sidebar'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?= $this->include('templates/topbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?= $this->renderSection('page-content'); ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Paradigma Pemrograman <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url(); ?>/login/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>

    <!-- Autocomplete Tambah Copy Buku -->
    <?php
    if (isset($buku)) {
        $data = [];
        foreach ($buku as $row) {
            $data[] = [
                'label'     =>  $row->judul . " - " . $row->id_buku,
                'value'     =>  $row->id_buku
            ];
        }
    }

    if (isset($anggota)) {
        $dataMahasiswa = [];
        foreach ($anggota as $row) {
            $dataMahasiswa[] = [
                'label'     =>  $row->nrp . " - " . $row->nama,
                'value'     =>  "999"
            ];
        }
    }

    if (isset($copy_buku)) {
        $dataCopyBuku = [];
        foreach ($copy_buku as $row) {
            $dataCopyBuku[] = [
                'label'     =>  $row->indeks_buku,
                'value'     =>  $row->indeks_buku
            ];
        }
    }

    if (isset($mahasiswa)) {
        $dataMhs = [];
        foreach ($mahasiswa as $row) {
            $dataMhs[] = [
                'label'     =>  $row->nrp . " - " . $row->nama,
                'value'     =>  $row->nrp
            ];
        }
    }

    ?>
    <script>
        // auto complete inputan buku
        <?php if (isset($buku)) { ?>
            var auto_complete = new Autocomplete(document.getElementById('buku'), {
                data: <?php if (isset($buku)) {
                            echo json_encode($data);
                        } ?>,
                maximumItems: 10,
                highlightTyped: true,
                highlightClass: 'fw-bold text-primary'
            });
        <?php } ?>

        // auto complete inputan nrp
        <?php if (isset($anggota)) { ?>
            var auto_complete_nrp = new Autocomplete(document.getElementById('nrp'), {
                data: <?php if (isset($anggota)) {
                            echo json_encode($dataMahasiswa);
                        } ?>,
                maximumItems: 10,
                highlightTyped: true,
                highlightClass: 'fw-bold text-primary'
            });
        <?php } ?>

        // auto complete inputan indeks buku
        <?php if (isset($copy_buku)) { ?>
            var auto_complete_nrp = new Autocomplete(document.getElementById('indeks_buku'), {
                data: <?php if (isset($copy_buku)) {
                            echo json_encode($dataCopyBuku);
                        } ?>,
                maximumItems: 10,
                highlightTyped: true,
                highlightClass: 'fw-bold text-primary'
            });
        <?php } ?>

        // auto complete inputan tugas akhir
        <?php if (isset($mahasiswa)) { ?>
            var auto_complete_nrp = new Autocomplete(document.getElementById('penulis'), {
                data: <?php if (isset($mahasiswa)) {
                            echo json_encode($dataMhs);
                        } ?>,
                maximumItems: 10,
                highlightTyped: true,
                highlightClass: 'fw-bold text-primary'
            });
        <?php } ?>
    </script>

    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.3.js"integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
    <script>
        var minDate, maxDate;

        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date( data[0] );
        
                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
        );
        
        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });
        
            // DataTables initialisation
            var table = $('#example').DataTable();
        
            // Refilter the table
            $('#min, #max').on('change', function () {
                table.draw();
            });
        });
    </script>
</body>

</html>