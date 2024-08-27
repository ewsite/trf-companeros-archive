<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

$sql = mysqli_query($con, "SELECT * FROM main_table WHERE status IN (2, 6, 7, 5)");
$approve_data = $sql->fetch_all(MYSQLI_ASSOC);


$deleted_sql = mysqli_query($con, "SELECT * FROM main_table WHERE status=0");
$deleted_data = $deleted_sql->fetch_all(MYSQLI_ASSOC);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>List of Approved Customers</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">List of Customer Accounts</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="color:green;font-weight:700;">List of Approved Customers</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Date Inquired</th>
                    <th>Full Name</th>
                    <th>Contact No.</th>
                    <th>Email Address</th>
                    <th>Package</th>
                    <th>Room No</th>
                    <th>Person</th>
                    <th>Price</th>
                    <th>Stay Duration</th>
                    <th>Message</th>
                    <th>Expected Date</th>
                    <th>Date Received</th>
                    <th>Downpayment Image</th>
                    <th>OR Number</th>
                    <th>Date Updated</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach($approve_data as $index => $result): ?>
                    <tr>
                      <td><?= $index + 1?></td>

                      <td><?php
                          echo $result['date_created'];
                          ?>
                      </td>
                      <td>
                        <?php
                        if ($result['customer_id'] == 0) {
                          echo '<span style="color:red;font-weight:bolder;">' . $result['inquiry_fullname'] . '</span>';
                        } else {
                          $result['inquiry_fullname'] = $result['fname'] . ' ' . $result['lname'] . $result['inquiry_fullname'];
                          echo '<span style="color:green;font-weight:bolder;">' . $result['inquiry_fullname'] . '</span>';
                        }
                        ?>

                      </td>
                      <td>
                        <?php
                        echo $result['cpnumber'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['email'];
                        ?>
                      </td>
                      <?php
                      if ($result['status'] == 7) {
                      ?>
                        <td disabled title="Ready to Start Session" style="background:green;color:red;font-weight:bolder" class="text-center disabled">
                          <?php
                          $pno = $result['package'];
                          if ($pno == 0) {
                          ?>
                          <?php
                          } else {
                            echo '<span  style="color:#ffff;font-weight:bolder;">' . $result['package'] . '</span>';
                          }
                          ?>
                        </td>
                      <?php
                      } else {
                      ?>
                        <td title="Click to Select Package" style="cursor:pointer;color:red;font-weight:bolder" class="text-center select-package btnSelectPackage2 disabled" inquiryid="<?php echo $result['main_id']; ?>" <?php if ($result['status'] == 6 || $result['status'] == 7) {
                                                                                                                                                                                                                              echo 'data-target=""';
                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                              echo 'data-toggle="modal" data-target="#modal-package"';
                                                                                                                                                                                                                            } ?>>
                          <?php
                          $pno = $result['package'];
                          if ($pno == 0) {
                          ?>
                          <?php
                          } else {
                            echo '<span style="color:green;font-weight:bolder;">' . $result['package'] . '</span>';
                          }
                          ?>
                        </td>
                      <?php
                      }
                      ?>
                      <td>
                        <?php
                        echo $result['room_no'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['person'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['customer_price'];
                        ?>
                      </td>
                      <td class="modalstay_duration" expand="<?php echo $result['stay_duration']; ?>" data-target="#modal-stay_duration" data-toggle="modal" title="<?php echo $result['stay_duration']; ?>" style=" max-width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                        <?php
                        echo $result['stay_duration']. " Hours";
                        ?>
                      </td>
                      <td class="modalmessage" expand="<?php echo $result['message']; ?>" title="<?php echo $result['message']; ?>" data-target="#modal-message" data-toggle="modal" style=" max-width: 100px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                        <?php
                        echo $result['message'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['expected_date'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['date_created'];
                        ?>
                      </td>
                      <?php
                      $downpay = $result['payment_one_img'];
                      if (!$downpay == "") {
                        echo $result['date_from_dppay'];
                      }
                      ?>
                      </td>
                      <td class="text-center">
                        <?php

                        if ($downpay == "") {
                        ?>
                          <i title="No Receipt Yet" class="fa fa-file-excel" style="font-size:40px;color:red;"></i>
                        <?php
                        } else { ?>

                          <a href="<?php echo $downpay; ?>" target="_blank">
                            <i title="Click to Preview the Receipt" class="fa fa-clipboard-check" style="font-size:40px;cursor:pointer;color:green;"></i>
                            <!-- <img src="./images/<?php echo  $downpay; ?>" target="_blank" alt="" width="100px"> -->
                            <!-- // echo $result['payment_one_img']; -->
                          </a><?php
                            }
                              ?>


                        <?php
                        ?>
                      </td>
                      <td title="Click to Edit OR Number" style="cursor:pointer;color:red;font-weight:bolder" class="text-center select-package InspectImg" pangalan="<?php echo $result['inquiry_fullname']; ?>" inquiryid="<?php echo $result['main_id']; ?>" customerid="<?php echo $result['customer_id']; ?>" paymentimg="<?php echo $result['payment_one_img']; ?>" orno="<?php echo $result['or_no1']; ?>" <?php if (empty($result['payment_one_img']) || $result['status'] == 6 || $result['status'] == 7) {
                                                                                                                                                                                                                                                                                                                                                                                                                    echo 'data-target=""';
                                                                                                                                                                                                                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                                                                                                                                                                                                                    echo 'data-toggle="modal" data-target="#modal-inspect"';
                                                                                                                                                                                                                                                                                                                                                                                                                  } ?>>
                        <?php
                        $orno1 = $result['or_no1'];
                        if (empty($orno1)) {
                          echo 'Empty';
                        } else {
                          echo '<span style="color:green;font-weight:bolder;">' . $orno1 . '</span>';
                        }

                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['date_update'];
                        ?>
                      </td>
                      <td>
                        <?php if($result["occupied"]): ?>
                          <i class="btn btn-success">Occupied</i>
                        <?php elseif($result["reserved"]): ?>
                          <i class="btn btn-success">Reserved</i>
                        <?php else: ?>
                          <i class="btn btn-secondary">None</i>
                        <?php endif ?>
                      </td>
                      <td>
                        <?php
                        if ($result['status'] == 0) {
                          echo "Deleted";
                        } elseif ($result['status'] == 1) {
                          echo "Inquiries";
                        } elseif ($result['status'] == 2) {
                          echo "Downpayment";
                        } elseif ($result['status'] == 3) {
                          echo "Cancelled";
                        } elseif ($result['status'] == 4) {
                          echo "Unreachable";
                        } elseif ($result['status'] == 5) {
                          echo "Done";
                        } elseif ($result['status'] == 6) {
                          echo "Downpayment Paid";
                        } elseif ($result['status'] == 7) {
                          echo "Fully Paid";
                        }

                        ?>
                      </td>
                      <td>
                        <?php if (intval(strtotime("now")) > intval(strtotime($result["expected_date"])) + 86400 || ($result["status"] != 6 && $result["status"] != 7)): ?>
                        <button class="btn btn-danger btn-sm btnDelete" id="inspect" deleteid="<?php
                                                                                                echo $result['main_id'];
                                                                                                ?>" title="Delete Inquiry"><i class="fas fa-trash-alt"></i></button>
                        <?php endif ?>
                        <?php
 

                        $start = $result['status'];


                        if ($start == 6) {
                        ?>
                          <button class="btn btn-success btn-sm btnforFullPayment" data-target="#modal-dppay" data-toggle="modal" mainid="<?php echo $result['main_id']; ?>" customerid="<?php echo $result['customer_id']; ?>" dppay="<?php echo $result['amountfor_dppay']; ?>" packageselect="<?php echo $result['package']; ?>" packagepriceselect="<?php echo $result['customer_price']; ?>" title="Click to input the full payment"><i class="fas fa-money-check-alt"></i></button>

                        <?php
                        } else {
                          # code...
                        }
                        // $cid = $result['customer_id'];
                        // $img1 = $result['payment_one_img'];
                        // $or1 = $result['or_no1'];

                        ?>
                      </td>
                    </tr>

                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Date Inquired</th>
                    <th>Full Name</th>
                    <th>Contact No.</th>
                    <th>Email Address</th>
                    <th>Package</th>
                    <th>Room No</th>
                    <th>Person</th>
                    <th>Price</th>
                    <th>Stay Duration</th>
                    <th>Message</th>
                    <th>Expected Date</th>
                    <th>Date Received</th>
                    <th>Downpayment Image</th>
                    <th>OR Number</th>
                    <th>Date Updated</th>
                    <th>Reason</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.col-md-6 -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>




<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>List of Deleted Customers </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">List of Customer Accounts</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- DELETED -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="color:red;font-weight:700;">List of Deleted Customers</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Date Inquired</th>
                    <th>Full Name</th>
                    <th>Contact No.</th>
                    <th>Email Address</th>
                    <th>Package</th>
                    <th>Room No</th>
                    <th>Person</th>
                    <th>Price</th>
                    <th>Stay Duration</th>
                    <th>Message</th>
                    <th>Expected Date</th>
                    <th>Date Received</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($deleted_data as $index => $result): ?>
                    <tr>
                      <td><?= $index + 1?></td>
                      <td><?php
                          echo $result['date_created'];
                          ?>
                      </td>
                      <td>
                        <?php

                        if ($result['customer_id'] == 0) {
                          echo '<span style="color:red;font-weight:bolder;">' . $result['inquiry_fullname'] . '</span>';
                        } else {
                          $result['inquiry_fullname'] = $result['fname'] . ' ' . $result['lname'] . $result['inquiry_fullname'];
                          echo '<span style="color:green;font-weight:bolder;">' . $result['inquiry_fullname'] . '</span>';
                        }
                        ?>

                      </td>
                      <td>
                        <?php
                        echo $result['cpnumber'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['email'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['package'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['room_no'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['person'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['customer_price'];
                        ?>
                      </td>
                      <td>
                        <?php
                       echo $result['stay_duration']. " Hours";
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['message'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['expected_date'];
                        ?>
                      </td>
                      <td>
                        <?php
                        $downpay = $result['payment_one_img'];
                        if (!$downpay == "") {
                          echo $result['date_from_dppay'];
                        }
                        ?>
                      </td>



                      <td>

                        <button class="btn btn-secondary btn-sm btnRetrieve" id="retrieve" retrieveid="<?php
                                                                                                        echo $result['main_id'];
                                                                                                        ?>" title="Retrieve Inquiry"><i class="fas fa-undo-alt"></i></button>

                        <?php
                        // $cid = $result['customer_id'];
                        // $img1 = $result['payment_one_img'];
                        // $or1 = $result['or_no1'];


                        ?>

                      </td>
                    </tr>

                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Date Inquired</th>
                    <th>Full Name</th>
                    <th>Contact No.</th>
                    <th>Email Address</th>
                    <th>Package</th>
                    <th>Room No</th>
                    <th>Person</th>
                    <th>Price</th>
                    <th>Stay Duration</th>
                    <th>Message</th>
                    <th>Expected Date</th>
                    <th>Date Received</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.col-md-6 -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>