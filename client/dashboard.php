<?php
include 'check_afk.php';

// Update the last activity timestamp
$_SESSION['last_activity'] = time();
if (empty($_SESSION['ticket'])) {
    header("location: ../index.php");
    exit();
}

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";;
// Check if the user is logged in and has a last activity timestamp
if (isset($_SESSION['customer_no'])) {

?>
    <!DOCTYPE html>
    <!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Client Dashboard</title>
        <!-- Jquery -->
        <script src="/plugins/jquery/jquery-3.7.1.min.js"></script>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <link rel="icon" href="/favicon.png">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="/favicon.png" height="100" width="100">
        </div>
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="index3.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> -->
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed;background:linear-gradient(to right, #00093c, #2d0b00);">
                <!-- Brand Logo -->
                <a href="#" class="brand-link">
                    <img src="/favicon.png" alt="logo" class="brand-image img-circle elevation-3">
                    <span class="brand-text font-weight-light">TRF Hotel- Campaňeros Hotel</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                        <div class="info">
                            <a href="#" class="d-block">Welcome, <?php echo $_SESSION['fname']; ?>
                                <?php
                                echo $_SESSION['lname']; ?>!</a>
                        </div>
                    </div>


                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                            <li class="nav-item">
                                <a href="?page=history" class="nav-link">
                                    <!-- <i class="nav-icon fas fa-th"></i> -->

                                    <lord-icon src="https://cdn.lordicon.com/ggqtvqxi.json" trigger="morph" colors="primary:#3080e8,secondary:#e86830" style="width:50px;height:50px;">
                                        <p style="text-align:right; transform:translate(50px,15px)">History</p>
                                    </lord-icon>
                                    <!-- <p style="text-align:center;">
                                    History
                                </p> -->

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?page=feedback" class="nav-link">
                                    <!-- <i class="nav-icon fas fa-th"></i> -->
                                    <lord-icon src="https://cdn.lordicon.com/mjmrmyzg.json" trigger="hover" colors="primary:#3080e8,secondary:#e86830" style="width:50px;height:50px">
                                        <p style="text-align:right; transform:translate(50px,15px)">Feedback</p>
                                    </lord-icon>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?page=changepass" class="nav-link">
                                    <!-- <i class="nav-icon fas fa-th"></i> -->
                                    <lord-icon src="https://cdn.lordicon.com/alnsmmtf.json" trigger="hover" colors="primary:#3080e8,secondary:#e86830" style="width:50px;height:50px">
                                        <p style="text-align:center;transform:translate(50px,15px);font-size:15px;">Change Password</p>
                                    </lord-icon>
                                    <!-- <p>
                                    Change Your Password
                                </p> -->
                                </a>
                            </li>
                            <li class="nav-item">
                            <?php 
                                $customerid = $_SESSION['customer_no'];
                                require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";;

                                $customer_id = intval($customerid); 
                                $sqlreserved = mysqli_query($con, "SELECT * FROM main_table WHERE customer_id='$customer_id'");
                                $reservation_permitted = true;

                                while ($result = mysqli_fetch_assoc($sqlreserved)) {
                                    // Sitll on process of downpayment
                                    if ($result['status'] == 6 || $result['status'] == 2) {
                                        $reservation_permitted = false;
                                        break; 
                                    }
                                    else {
                                        $reservation_permitted = true;
                                    }
                                }

                                if ($reservation_permitted) {
                            ?>
                                <a href="?page=reservation" class="nav-link">
                                    <lord-icon src="https://cdn.lordicon.com/scpmeqro.json" trigger="hover" colors="primary:#3080e8,secondary:#e86830" style="width:50px;height:50px">
                                        <p style="text-align:right; transform:translate(50px,15px)">Reservation</p>
                                    </lord-icon>
                                </a>
                            <?php
                                }else{
                                    ?>
                                    <span class="nav-link">
                                    <lord-icon src="https://cdn.lordicon.com/scpmeqro.json" trigger="hover" colors="primary:#3080e8,secondary:#e86830" style="width:50px;height:50px">
                                        <p style="text-align:right; transform:translate(50px,15px)">Reservation Disabled</p>
                                    </lord-icon>
                                </span>
                                <?php
                                }
                            ?>
                            </li>
                        </ul>
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="logout.php" class="nav-link">
                                    <lord-icon src="https://cdn.lordicon.com/hcuxerst.json" trigger="hover" colors="primary:#3080e8,secondary:#e86830" style="width:50px;height:50px">
                                        <p style="text-align:right; transform:translate(50px,15px)">Logout</p>
                                    </lord-icon>
                                    <!-- <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Logout
                                </p> -->
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->

            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <div class="content-wrapper">
                <?php
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                    switch ($page) {
                        case 'history':
                            include "history.php";
                            break;

                        case 'feedback':
                            include "feedback.php";
                            break;

                        case 'changepass':
                            include "cpass.php";
                            break;

                        case 'reservation':
                            include "reserve.php";
                            break;

                        default:
                            include "history.php";
                            break;
                    }
                } else {
                    include "history.php";
                }
                ?>


                <!-- /.content-header -->
                <!-- Main content -->
                <!-- /.content -->
            </div>
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            </footer>
        </div>
        <!-- ./wrapper -->
        <div class="modal fade" id="modal-uploads">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Upload Transaction Image(Gcash)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="insertimg-body">
                        <!-- <p>One fine body&hellip;</p> -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnsaveinsert">Upload</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="funct  ion.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="plugins/jszip/jszip.min.js"></script>
        <script src="plugins/pdfmake/pdfmake.min.js"></script>
        <script src="plugins/pdfmake/vfs_fonts.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
        <!-- Page specific script -->
        <script>
            // $("#btnsaveinsert").click(function() {
            //     var inputFile = $("input[type='file']")[0];
            //     var file = inputFile.files[0];

            //     if (file) {
            //         var reader = new FileReader();

            //         reader.onload = function(e) {
            //             e.preventDefault();
            //             var imageData = e.target.result;
            //             alert(imageData);

            //             $.ajax({
            //                 url: "transaction-upload-dash.php",
            //                 type: "POST",
            //                 data: {
            //                     customer_id: customer_id,
            //                     main_id: main_id,
            //                     imageData: imageData
            //                 },
            //                 success: function(response) {
            //                     alert(customer_id);
            //                 }
            //             });
            //         };

            //      }
            // });



            $(function() {
                $("#example1").DataTable({
                    "responsive": false,
                    "lengthChange": true,
                    "autoWidth": true,
                    "paging": true,
                    "ordering": false,
                    "searching": false,
                    "info": true,
                    "buttons": ["colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
        <script>
            //chech if the user is idle or AFK
            var idleTime = 0;

            // Increment idleTime on user activity
            $(document).on('mousemove keydown', function() {
                idleTime = 0;
            });

            // Send AJAX request to update last activity time
            function updateLastActivity() {
                $.ajax({
                    url: 'check_afk.php',
                    success: function(response) {
                        // Handle the response if needed
                    }
                });
            }

            // Start checking idle time
            setInterval(function() {
                idleTime += 1;
                if (idleTime >= 300) { // Idle threshold reached (e.g., 10 seconds)
                    window.location.href = ' ../index.php'; // Redirect to login.php
                } else {
                    updateLastActivity(); // Update last activity time
                }
            }, 1000); // Check every 1 second (1000 milliseconds)
        </script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- <script src="dist/js/demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    </body>

    </html>
<?php
}
?>