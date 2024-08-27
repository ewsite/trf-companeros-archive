<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (empty($_SESSION['ticket'])) {
  header("location:index.php");
  exit();
}

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (isset($_SESSION['id'])) {
}

// 
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
    <title>TRF Hotel  | Admin Dashboard</title>
    <link rel="icon" href="images/logo.png">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="build/scss/mixins/_accent.scss">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
    <script src="/plugins/sweetalert2/sweetalert2.all.min.js" defer></script>
  </head>
  <style>
    .no-spin::-webkit-inner-spin-button,
    .no-spin::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>

  <body class="hold-transition sidebar-mini">
    <script>
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
    </script>
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="/favicon.png"  height="100" width="100">
    </div>/
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

        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed;background: rgb(19, 30, 37);" >
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
          <img src="/favicon.png" alt="Saint Mark Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">TRF Hotel- Campaňeros Hotel</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!-- <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div> -->
            <div class="info">
              <a href="#" class="d-block">Welcome, 
                <?php 
                  if ($_SESSION['position']=='Admin') {
                    ?>
                  <span style="text-transform: uppercase;color:red;font-size:20px;font-weight:700;"> <?php echo $_SESSION['position']; ?></span></a>
                    <?php 
                  }elseif ($_SESSION['position']=='Secretary') {
                    ?>
                    <span style="text-transform: uppercase;color:yellow;font-size:20px;font-weight:700;"> <?php echo $_SESSION['position']; ?></span></a>
                    <?php
                  }
                ?>
            </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

              <li class="nav-item">
                <a href="?page=dashboard" class="nav-link">
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=inquiries" class="nav-link">
                  <p>
                    Inquiries
                  </p>
                </a>
              </li>

              <li class="nav-item menu-close">
                <a href="?page=FAQ" class="nav-link">
                  <p>
                    Front Web
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?page=FAQ/Feedback" class="nav-link">
                      <p>Feedback</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?page=FAQ/gallery" class="nav-link">
                      <p>
                        Gallery
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?page=packages" class="nav-link">
                      <p>
                        Packages
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="?page=user-accounts" class="nav-link">
                  <p>
                    User Accounts
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=customer-approve" class="nav-link">
                  <p>
                    Approved
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link">
                  <p>
                    Log Out
                  </p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php
        if (isset($_GET["page"])) {
          $page = $_GET["page"];
          switch ($page) {
            case 'dashboard':
              include "dash.php";
              break;

            case 'inquiries':
              include "inquiry.php";
              break;

            case 'FAQ/gallery':
              include "gallery.php";
              break;

            case 'FAQ/Feedback':
              include "feedbacks.php";
              break;

            case 'user-accounts':
              include "user-accounts.php";
              break;
            
            case 'room':
              include "room.php";
              break;

            case 'packages':
              include "packages.php";
              break;


            case 'customer-approve':
              include "customer-approve.php";
              break;

            default:
              include "dash.php";
              break;
          }
        } else {
          include "dash.php";
        }
        ?>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <aside class="control-sidebar control-sidebar-dark" style="display: block;">
          <!-- Control sidebar content goes here -->

        </aside>
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2024 TRF Hotel Companeros, All rights reserved.
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- MODALS -->
    <!-- REQUIRED SCRIPTS -->
    <!-- View More Modal -->
    <div class="modal fade" id="modal-inclusion">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Inclusion View</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="inclusion">
          </div>
          <div class="modal-footer justify-content-between">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-message">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Message View</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="message">
          </div>
          <div class="modal-footer justify-content-between">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Account</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="editaccount">

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btneditaccountsave">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!--MODAL FOR SEARCH CUSTOMER-->
    <div class="modal fade" id="modal-search">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Search Customer has already Account</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="searchcustomer">

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--MODAL FOR SEARCH CUSTOMER-->

    <!--MODAL FOR SELECT PACKAGE-->
    <div class="modal fade" id="modal-package">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Package</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="packageedit">

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btnConfirm">Confirm</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- MODAL FOR EDIT O.R -->
    <div class="modal fade" id="modal-inspect">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Inspect Image</h4>
            <button onclick="Modalreload()" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="btnExiticon">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal-inspect-img">

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btnInspectSave">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-expectdate">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Expected Date</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="btnExiticon">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal-expecteddate">

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btnInspectSave">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-editmanagepackage">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Manage Room</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="btnExiticon">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="managepackage-body">

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btnManagePackageSave">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-dppay">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Full Payment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="btnExiticon">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="fullpaymodal-body">
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btnReadyFullPay">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-createacc">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Create Account for Customer Inquire</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="btnExiticon">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="createacc-body">

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary " id="btnSaveAccInquiry">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Ekko Lightbox -->
    <script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- Filterizr-->
    <script src="plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- dropzonejs -->
    <script src="plugins/dropzone/min/dropzone.min.js"></script>


    <script>
      //inquiry id and customer id is public
      var inquiryid = 0; //main_id
      var customer_id = 0; //id for customer has account
      var customerno = 0; //count from inquiry customer, if customer has no account

      //ajax for fullpayment paying 
      $("#btnReadyFullPay").click(function() {
        var restpay = $("#amountforfullpay").val();
        Swal.fire({
          title: "Reservation",
          html: "Please Wait :)",
          didOpen: () => {
            Swal.showLoading();
          }
        })
        $.ajax({
          url: "restpayment.php",
          type: "POST",
          data: {
            restpay: restpay,
            customerid: customerid,
            mainid: mainid
          },
          success: function(response) {
            if (response == 'Success') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success',
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                      location.reload();
                    }
                });
              }
              else {
                Swal.fire({
                  position: 'center',
                  icon: 'warning',
                  title: response,
                  color: '#000000',
                  showConfirmButton: false,
                  timer: 2000
                });
              }
          }
        });
      })



      //ajax for showing extended inclusion in approved
      $('.modalinclusion').click(function() {
        var expand = $(this).attr("expand");
        $.ajax({
          url: "inclusionexpand.php",
          type: "POST",
          data: {
            expand: expand
          },
          success: function(response) {
            $("#inclusion").html(response);


          }
        });
      });

      //ajax for showing extended message in approved
      $('.modalmessage').click(function() {
        var expand = $(this).attr("expand");
        $.ajax({
          url: "messageexpand.php",
          type: "POST",
          data: {
            expand: expand
          },
          success: function(response) {
            $("#message").html(response);


          }
        });
      });

      //ajax to save create customer account inquiry
      $('#btnSaveAccInquiry').click(function() {
        var edituser = $('#inputuser').val();
        var editlname = $('#inputlname').val();
        var editfname = $('#inputfname').val();
        var editpass = $('#inputpass').val();
        var editretypepass = $('#inputretypepass').val();
        var editcontact = $('#inputcontact').val();
        var editemail = $('#inputemail').val();

        if (edituser == '') {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Input Username',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          })

        } else if (editlname == '') {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Input Last Name',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          })
        } else if (editfname == '') {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Input First Name',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          })
        } else if (editpass == '') {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Input Password',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          })
        } else if (editretypepass == '') {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Input Retype Password',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          })
        } else if (editcontact == '') {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Input Contact',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          })
        } else if (editemail == '') {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Input Email',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          })
        } else if (editcontact.length < 11) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Contact must be 11 numbers high',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          })
        } else if (editretypepass != editpass) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Passwords do not match!',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          })
        } else if (editretypepass.length < 8) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Password must be at least 8 characters long',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          })
        } else if (!editemail.toLowerCase().includes('@gmail.com')) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Invalid Email Address! Only Gmail addresses are allowed.',
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          });
        } else {
          $.ajax({
            url: "account-createinquiryprocess.php",
            method: "POST",
            data: {
              inquiryid: inquiryid,
              edituser: edituser,
              editlname: editlname,
              editfname: editfname,
              editpass: editpass,
              editcontact: editcontact,
              editemail: editemail
            },
            success: function(response) {
              if (response == 'Email or Username is already exists') {
                Swal.fire({
                  position: 'center',
                  icon: 'warning',
                  title: 'Email or Username is already exists',
                  color: '#000000',
                  showConfirmButton: false,
                  timer: 1500
                });
              } else if (response == 'Account Create Error') {
                Swal.fire({
                  position: 'center',
                  icon: 'danger',
                  title: 'Account Create Error',
                  color: '#000000',
                  showConfirmButton: false,
                  timer: 1500
                });
                setTimeout(function() {
                   
                }, 2000)
              } else if (response == 'Account Created Successfully') {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Successfully Sign-up',
                  color: '#000000 ',
                  showConfirmButton: false,
                  timer: 1500,
                  willClose: () => {
                      location.reload()
                  }
                });
              }
            }
          })
        }
      })


      $(".btnUploadGalleryImg").click(function(e) {
        e.preventDefault();
        var childdivCount = $(".child-div").length;
        $(".child-div").each(function() {
          var imageData = $(this).attr("src");

          Swal.fire({
            title: "Uploading",
            html: "Please Wait :)",
            didOpen: () => {
              Swal.showLoading();
            }
          })
          // Send the image data to the server-side PHP script for database insertion
          $.ajax({
            url: "uploadimage-process.php",
            type: "POST",
            data: {
              imageData: imageData
            },
            success: function(response) {
              if (response == 'Image inserted successfully.') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Image inserted successfully.',
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                      window.location.href = "/";
                    }
                });
              }
              else {
                Swal.fire({
                  position: 'center',
                  icon: 'warning',
                  title: response,
                  color: '#000000',
                  showConfirmButton: false,
                  timer: 2000
                });
              }

            }
          });
        });
      })

      $(".btnDeleteGalleryImg").click(function() {
        deleteimg = $(this).attr('image');
        Swal.fire({
          title: 'Want to Delete?',
          text: "You won't be able to retrive this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'delete-galleryimg.php',
              method: 'POST',
              data: {
                deleteimg: deleteimg

              },
              success: function(response) {
                Swal.fire(
                  'Deleted!',
                  'The Image has been deleted.',
                  'success',

                ), setTimeout(function() {
                  location.reload()
                }, 1000);
              }
            })

          }
        })
      })
      // button to post feedback message
      $(".btnPostFeeds").click(function() {
        var feedid = $(this).attr('feedid');
        var clientid = $(this).attr('clientid');
        var lname = $(this).attr('lname');
        var datesend = $(this).attr('datesend');
        var email = $(this).attr('email');
        var message = $(this).attr('message');
        Swal.fire({
          title: 'Want to Post in Public?',
          text: "make sure its a positive review!",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, post it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'post-feed.php',
              method: 'POST',
              data: {
                feedid: feedid,
                clientid: clientid,
                lname: lname,
                datesend: datesend,
                email: email,
                message: message
              },
              success: function(response) {
                if (response.trim() == "Failed") {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Max Capacity Reached!',
                    footer: 'You need to deleted from public feedback to proceed'
                  })
                } else {
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success',
                    html: 'selected feedback is now posted to the public!',
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                      location.reload()
                    }
                });
                }

              }
            })
          }
        })
      })


      $(".btnDeleteFeeds").click(function() {
        var delete_feed = $(this).attr('deleteid');
        Swal.fire({
          title: 'Want to Delete?',
          text: "You won't be able to retrive this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'delete-feed.php',
              method: 'POST',
              data: {
                delete_feed: delete_feed

              },
              success: function(response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success',
                    html: 'selected feedback is deleted successfully.',
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                      location.reload()
                    }
                });
              }
            })

          }
        })
      })


      //ajax for showing modal for full payment approved cus
      $(".btnforFullPayment").click(function() {
        mainid = $(this).attr('mainid');
        customerid = $(this).attr('customerid');
        balance = $(this).attr('dppay');
        packagepriceselect = $(this).attr('packagepriceselect');
        $.ajax({
          url: 'modal-forfullpayment.php',
          method: 'POST',
          data: {
            mainid: mainid,
            customerid: customerid,
            balance: balance,
            packagepriceselect: packagepriceselect
          },
          success: function(response) {
            $("#fullpaymodal-body").html(response);
          }
        })
      })

      //ajax for showing modal create account
      $(".btnCreateAccInquiry").click(function() {
        inquiryid = $(this).attr('inquiryid');
        contact = $(this).attr('contact');
        email = $(this).attr('email');

        $.ajax({
          url: 'modal-createaccinquiry.php',
          method: 'POST',
          data: {
            inquiryid: inquiryid,
            contact: contact,
            email: email
          },
          success: function(response) {
            // alert(packageid);
            $("#createacc-body").html(response);
          }
        })
      })

      //ajax for showing modal manage package
      $(".btnModalManagePackage").click(function() {
        let room_no = $(this).attr("roomno");
        $.ajax({
          url: 'modal-managepackage.php',
          method: 'POST',
          data: {
            room_no: room_no
          },
          success: function(response) {
            // alert(packageid);
            $("#managepackage-body").html(response);
          }
        })
      })

      //Ajax for showing modal search in inquiry 
      $("#modal-expecteddate").click(function() {
        // alert("hehe");
        var name = $(this).attr('pangalan');
        inquiryid = $(this).attr('inquiryid');

        $.ajax({
          url: 'search-modal.php',
          method: 'POST',
          data: {
            inquiryid: inquiryid,
            name: name
          },
          success: function(response) {
            $("#searchcustomer").html(response);
          }
        })
      })


      //Ajax for showing modal edit approve modal 
      $(".btnSearchCustomer").click(function() {
        // alert("hehe");
        var name = $(this).attr('pangalan');
        inquiryid = $(this).attr('inquiryid');

        $.ajax({
          url: 'search-modal.php',
          method: 'POST',
          data: {
            inquiryid: inquiryid,
            name: name
          },
          success: function(response) {
            $("#searchcustomer").html(response);
          }
        })
      })



      //Ajax for showing modal edit from accounts
      $(".btnEditAcc").click(function() {
        // alert("hehe");
        var id = $(this).attr('id');
        customerno = $(this).attr('customerno'); //
        var lname = $(this).attr('lname');
        var fname = $(this).attr('fname');
        var user = $(this).attr('user');
        var pass = $(this).attr('pass');
        var contact = $(this).attr('contact');
        var email = $(this).attr('email');

        $.ajax({
          url: 'edit-account.php',
          method: 'POST',
          data: {
            customerno: customerno,
            lname: lname,
            fname: fname,
            user: user,
            pass: pass,
            contact: contact,
            email: email
          },
          success: function(response) {
            $("#editaccount").html(response);
          }
        })
      })


      //Ajax showing modal package to edit approved
      $(".btnSelectPackage2").click(function() {
        // alert("hehe");
        var name = $(this).attr('pangalan');
        inquiryid = $(this).attr('inquiryid');
        $.ajax({
          url: 'package-edit.php',
          method: 'POST',
          data: {
            inquiry_id: inquiryid

          },
          success: function(response) {
            $("#packageedit").html(response);
          }
        })
      })
      //Ajax showing modal package to edit approved


      //Ajax showing modal package to edit inquiries
      $(".btnSelectPackage").click(function() {
        // alert("hehe");
        var name = $(this).attr('pangalan');
        inquiryid = $(this).attr('inquiryid');
        $.ajax({
          url: 'package-edit.php',
          method: 'POST',
          data: {
            inquiry_id: inquiryid

          },
          success: function(response) {
            $("#packageedit").html(response);
          }
        })
      })
      //Ajax showing modal package to edit inquiries

      //Ajax modal for OR Inspect
      function Modalreload() {
        location.reload();
      }

      $(".ExpectDateEdit").click(function() {
        // alert("hehe");
        var name = $(this).attr('#pangalan');
        inquiryid = $(this).attr('inquiryid');
        expecteddate = $(this).attr('expectdate');
        // modal-expect
        $.ajax({
          url: 'expecteddate-edit.php',
          method: 'POST',
          data: {
            inquiryid: inquiryid,
            expecteddate: expecteddate
          },
          success: function(response) {
            $("#modal-expecteddate").html(response);

          }

        })
      })

      //MODAL PARA SA OR No. BUTTON
      $(".InspectImg").click(function() {
        // alert("hehe");
        var name = $(this).attr('pangalan');
        inquiryid = $(this).attr('inquiryid');
        customerid = $(this).attr('customerid');

        // modal-inspect-img
        $.ajax({
          url: 'inspect-img.php',
          method: 'POST',
          data: {
            inquiryid: inquiryid,
            customerid: customerid

          },
          success: function(response) {
            $("#modal-inspect-img").html(response);
          }
        })
      })
      //ajax to save price and inclusion manage package
      $("#btnManagePackageSave").click(function() {
        let data = Object.fromEntries(new FormData(document.getElementById("lyney")))

        Swal.fire({
            title: "Changing Prices",
            html: "Please Wait....",
            didOpen: () => {
              Swal.showLoading();
            }
        })

        $.ajax({
          url: 'managepackage-process.php',
          method: "POST",
          data: {
            modifiedPackageData: JSON.stringify(data),
            room_no: room_no
          },
          success: function(response) {
            if (response == "Success") {
                  Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: `Room ${room_no} successfully updated`,
                      color: '#000000',
                      showConfirmButton: false,
                      timer: 1500,
                      willClose: () => {
                          location.reload();
                      }
                  });
              } else {
                  Swal.fire({
                      position: 'center',
                      icon: 'warning',
                      title: response,
                      color: '#000000',
                      showConfirmButton: false,
                      timer: 1500
                  });
              }
        }
      })
    })
      //ajax to save price and inclusion manage package

      $("#btnInspectSave").click(function() {

        var or_no1 = $("#orno1").val();
        var cus_amount = $("#currencyfield").val();
        var half = $("#half").val();
        var total = document.getElementById("price").innerHTML;
        
        
        Swal.fire({
          title: "Processing...",
          html: "Please Wait :)",
          didOpen: () => {
            Swal.showLoading();
          }
        })
        $.ajax({
          url: 'orno1-savechange.php',
          method: 'POST',
          data: {
            or_no1: or_no1,
            cus_amount: cus_amount,
            inquiryid: inquiryid,
            customerid: customerid,
            price: price,
            half: half,
            total: total

          },
          success: function(response) {
            if (response == 'Success') {
              Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Success',
                  color: '#000000',
                  showConfirmButton: false,
                  timer: 2000,
                  willClose: () => {
                    location.reload();
                  }
              });
            }
            else {
              Swal.fire({
                position: 'center',
                icon: 'warning',
                title: response,
                color: '#000000',
                showConfirmButton: false,
                timer: 2000
              });
            }
          }
        })
      })

      $("#btnConfirm").click(function() {
        $("#package-edit").submit();
      })
      //Delete Accounts
      $(".btnDeleteAcc").click(function() {
        var delete_account = $(this).attr('deleteacc');
        Swal.fire({
          title: 'Want to Delete?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'delete-account.php',
              method: 'POST',
              data: {
                delete_account: delete_account

              },
              success: function(response) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Deleted',
                  html: 'Account Deleted Successfully',
                  color: '#000000',
                  showConfirmButton: false,
                  timer: 2000,
                  willClose: () => {
                    location.reload();
                  }
              });
              }
            })

          }
        })

        // inquiryid=$(this).attr('inquiryid');
      })

      $(".btnDelete").click(function() {
        var delete_inquiry = $(this).attr('deleteid');
        Swal.fire({
          title: 'Want to Delete?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'delete-inquiry.php',
              method: 'POST',
              data: {
                delete_inquiry: delete_inquiry
              },
              success: function(response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success',
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                      location.reload()
                    }
                });
              }
            })

          }
        })

        // inquiryid=$(this).attr('inquiryid');
      })

      $(".btnRetrieve").click(function() {
        var retrieve_inquiry = $(this).attr('retrieveid');
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'The row has been Retrieved',
          showConfirmButton: false,
          timer: 1500,
          willClose: () => {
                      location.reload()
          }
        })
        $.ajax({
          url: 'retrieve-inquiry.php',
          method: 'POST',
          data: {
            retrieve_inquiry: retrieve_inquiry

          },
          success: function(response) {
            setTimeout(function() {
               
            }, 3000);
          }
        })


        // inquiryid=$(this).attr('inquiryid');
      })


      $('.btnApprove').click(function() {
        var aprove_inquiryid = $(this).attr('inquiryid');
        Swal.fire({
          title: 'Are you sure?',
          text: "Are you sure you want to Approve this customer?",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, I Approve it!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: "Inquiry",
              html: "Please Wait :)",
              didOpen: () => {
                Swal.showLoading();
              }
            })
            $.ajax({
              url: 'approve-inquiryprocess.php',
              method: "POST",
              data: {
                aprove_inquiryid: aprove_inquiryid
              },
              success: function(response) {
                if (response.trim() == "Approve") {
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Inquiry Approved Successfully!',
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                      location.reload();
                    }
                  });
                } else {
                  Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: response,
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000
                  });
                }

              }
            })
          }
        })

      })

      //ajax to save edited customer account
      $('#btneditaccountsave').click(function() {
        var edituser = $('#inputuser').val();
        var editlname = $('#inputlname').val();
        var editfname = $('#inputfname').val();
        var editpass = $('#inputpass').val();
        var editretypepass = $('#inputretypepass').val();
        var editcontact = $('#inputcontact').val();
        var editemail = $('#inputemail').val();
        if (edituser == 0) {
          alert("Input User");
        } else if (editlname == 0) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: "Input Last Name",
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          });
        } else if (editfname == 0) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: "Input First Name",
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          });
        } else if (editpass == 0) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: "Input Password",
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          });
        } else if (editretypepass == 0) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: "Input Retype Password",
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          });
        } else if (editpass !== editretypepass) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: "Password and Re-type password mismatch!",
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          });
        } else if (editcontact == 0) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: "Input Contact",
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          });
        } else if (editemail == 0) {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: "Input Email",
            color: '#000000',
            showConfirmButton: false,
            timer: 2000
          });
        } else {
          
          Swal.fire({
            title: "Editing Account",
            html: "Please Wait :)",
            didOpen: () => {
              Swal.showLoading();
            }
          })
          $.ajax({
            url: "account-editprocess.php",
            method: "POST",
            data: {
              customerno: customerno,
              edituser: edituser,
              editlname: editlname,
              editfname: editfname,
              editpass: editpass,
              editcontact: editcontact,
              editemail: editemail
            },
            success: function(response) {
              if (response == 'Success') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success',
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                      location.reload();
                    }
                });
              }
              else {
                Swal.fire({
                  position: 'center',
                  icon: 'warning',
                  title: response,
                  color: '#000000',
                  showConfirmButton: false,
                  timer: 2000
                });
              }
            }
          })
        }
        // alert(cbopackage + petsa +cbotime);

      })

      $("#example1").DataTable({
        // "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $("#example2").DataTable({
        // "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "print", "colvis"]
      }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');


      //START NG ATTACH CUSTOMER ITOO


      $(".btnEditInquiry").click(function() {
        var name = $(this).attr('pangalan');
        inquiryid = $(this).attr('inquiryid');
      })
      //END NG ATTACH CUSTOMER ITOO

      $("#search-client").DataTable({
        // "responsive": true,
        "lengthChange": false,
        "autoWidth": false
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');





      $(".btnSelectPackage").click(function() {
        $("#btnConfirm").prop("disabled", true);
        $("#msg").hide();
        inquiryid = $(this).attr('inquiryid');


        // $.ajax({
        //   url: 'attach-cust.php',
        //   method: 'POST',
        //   data: {
        //     inquiryid: inquiryid,
        //     customer_id: customer_id
        //   },
        //   success: function(response) {
        //     alert(response);
        //   }
        // })
        // inquiryid=$(this).attr('inquiryid');

        // alert(inquiryid);
      })
    </script>
    <script>
      $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox({
            alwaysShowClose: true
          });
        });

        $('.filter-container').filterizr({
          gutterPixels: 3
        });
        $('.btn[data-filter]').on('click', function() {
          $('.btn[data-filter]').removeClass('active');
          $(this).addClass('active');
        });
      })

      // DropzoneJS Demo Code Start
      Dropzone.autoDiscover = false

      // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
      var previewNode = document.querySelector("#template")
      previewNode.id = ""
      var previewTemplate = previewNode.parentNode.innerHTML
      previewNode.parentNode.removeChild(previewNode)

      var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "uploadimage-process.php", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
      })

      myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() {
          myDropzone.enqueueFile(file)
        }
      })

      // Update the total progress bar
      myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
      })

      myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
      })

      // Hide the total progress bar when nothing's uploading anymore
      myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0"
      })

      // Setup the buttons for all transfers
      // The "add files" button doesn't need to be setup because the config
      // `clickable` has already been specified.
      document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
      }
      document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true)
      }
      // DropzoneJS Demo Code End
    </script>
  </body>

  </html>