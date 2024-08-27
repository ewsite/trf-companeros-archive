<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Your Pending Reservation</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">List of Pending Reservation</li>
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
            <h3 class="card-title" style="color:green;font-weight:700;">Your Current Reserve</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped" width="100%">
                <thead>
                  <th>#</th>
                  <th>Date Created</th>
                  <th>Package</th>
                  <th>Room #</th>
                  <th>Person</th>
                  <th>Price</th>
                  <th>Stay Duration</th>
                  <th>Expected Date</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Payment Status</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                  include('connection.php');
                  $status = array(2, 6, 7);
                  $statusValues = array_map('intval', $status);
                  $statusList = implode(',', $statusValues);
                  $customer_no = $_SESSION['customer_no'];
                  $sql = mysqli_query($con, "select * from main_table where customer_id='$customer_no' and status IN (2,6)");
                  $i = 1;
                  while ($result = mysqli_fetch_assoc($sql)) {
                  ?>
                    <tr>
                      <td><?php
                          echo  $i . ".";
                          $i++;
                          ?></td>
                      <td> <?php
                            echo $result['date_created'];
                            ?></td>
                      <td> <?php
                            echo $result['package'];
                            ?></td>
                      <td> <?php
                            echo "Room ".$result['room_no'];
                            ?></td>
                      <td> <?php
                            echo $result['person'];
                            ?></td>
                      <td> <?php
                            echo $result['customer_price'];
                            ?></td>
                      <td> <?php
                            echo $result['stay_duration']. " Hours";
                            ?></td>
                      <td> <?php
                            echo $result['expected_date'];
                            ?></td>
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
                      <td>
                        <?php if($result["occupied"]): ?>
                          <i class="btn btn-success">Occupied</i>
                        <?php elseif($result["reserved"]): ?>
                          <i class="btn btn-success">Reserved</i>
                        <?php else: ?>
                          <i class="btn btn-secondary">None</i>
                        <?php endif ?>
                      </td>
                      <td> <?php
                            if (empty($result['payment_one_img'])){
                              echo "Waiting for payment";
                            }else{

                              if ($result['status']==6) {
                                echo "Your payment has been Approved!";
  
                              }else{
                                echo "Your payment has been waiting for  Approval";
                              }
                            }
                      
                            ?></td>
                      <td>
                      <?php
                            if (empty($result['payment_one_img'])){
                              ?>
                                  <button style="border:none;" data-toggle="modal" data-target="#modal-uploads" class="btn btn-warning btninsert" customer_id=<?php echo $result['customer_id']; ?> main_id=<?php echo $result['main_id']; ?>><i class="fa fa-upload" style="color: white;"></i></button></td>
                              <?php
                            }else{
                              
                            }

                            ?>

                    </tr>
                </tbody>
              <?php
                  }
              ?>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Date Created</th>
                  <th>Package</th>
                  <th>Room #</th>
                  <th>Person</th>
                  <th>Price</th>
                  <th>Stay Duration</th>
                  <th>Expected Date</th>
                  <th>Image</th>
                  <th>Status</th>
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

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="color:green;font-weight:700;">Your History</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-striped" width="100%">
                <thead>
                  <th>#</th>
                  <th>Date Created</th>
                  <th>Package</th>
                  <th>Room #</th>
                  <th>Person</th>
                  <th>Price</th>
                  <th>Stay Duration</th>
                  <th>Expected Date</th>
                  <th>Status</th>
                  <th>Payment Status</th>
                </thead>
                <tbody>
                  <?php
                  $customer_no = $_SESSION['customer_no'];
                  $sql = mysqli_query($con, "select * from main_table where customer_id='$customer_no' and status IN (3, 4, 5, 7)");
                  $i = 1;
                  while ($result = mysqli_fetch_assoc($sql)) {
                  ?>
                    <tr>
                      <td><?php
                          echo  $i . ".";
                          $i++;
                          ?></td>
                      <td> <?php
                            echo $result['date_created'];
                            ?></td>
                      <td> <?php
                            echo $result['package'];
                            ?></td>
                      <td> <?php
                            echo "Room ".$result['room_no'];
                            ?></td>
                      <td> <?php
                            echo $result['person'];
                            ?></td>
                      <td> <?php
                            echo $result['customer_price'];
                            ?></td>
                      <td> <?php
                            echo $result['stay_duration']. " Hours";
                            ?></td>
                      <td> <?php
                            echo $result['expected_date'];
                            ?></td>
                      <td>
                        <?php if($result["occupied"]): ?>
                          <i class="btn btn-success">Occupied</i>
                        <?php elseif($result["reserved"]): ?>
                          <i class="btn btn-success">Reserved</i>
                        <?php else: ?>
                          <i class="btn btn-secondary">None</i>
                        <?php endif ?>
                      </td>
                      <td> <?php
                      if ($result['status'] == 3) {
                        echo "Cancelled";
                      }elseif ($result['status'] == 4) {
                        echo "Unreachable";
                      }elseif ($result['status'] == 5) {
                        echo "Done";
                      }elseif ($result['status'] == 7) {
                        echo "Fully Paid";
                      }
                            ?></td>

                    </tr>
                </tbody>

              <?php
                  }
              ?>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Date Created</th>
                  <th>Room #</th>
                  <th>Person</th>
                  <th>Price</th>
                  <th>Stay Duration</th>
                  <th>Expected Date</th>
                  <th>Status</th>
                  <th>Payment Status</th>
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
<script>
  $(".btninsert").click(function() {
    customerid = $(this).attr('customer_id');
    mainid = $(this).attr('main_id');

    $.ajax({
      url: 'insertimg.php',
      method: 'POST',
      data: {
        customerid: customerid,
        mainid: mainid,
      },
      success: function(response) {
        $("#insertimg-body").html(response);
      }
    })

  })
</script>