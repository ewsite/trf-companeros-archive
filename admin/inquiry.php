<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";


$sql = mysqli_query($con, "SELECT * FROM main_table WHERE status='1'");
$inquiry_data = $sql->fetch_all(MYSQLI_ASSOC);


?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Inquiry</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Inquiry</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List of Inquired Customers</h3>
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
                    <th>Room #</th>
                    <th>Person</th>
                    <th>Price</th>
                    <th>Message</th>
                    <th>Expected Date</th>
                    <th>Remarks</th>
                    <th>Date Updated</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php foreach($inquiry_data as $index => $info): ?>
                  <tr>
                    <!-- Field (#) -->
                    <td><?= $index + 1 ?></td>

                    <!-- Field Date Inquired -->
                    <td><?= $info["date_created"] ?></td>

                    <!-- Field Date Full Name -->
                    <td>
                      <?php if ($info["customer_id"] == 0): ?>
                        <span style="color:red;font-weight:bolder;"><?= $info["inquiry_fullname"] ?></span>
                      <?php else: ?>
                        <span style="color:green;font-weight:bolder;"><?= $info["inquiry_fullname"] ?></span>
                      <?php endif ?>
                    </td>

                    <!-- Field Date Phone Number -->
                    <td><?= $info["cpnumber"] ?></td>

                    <!-- Field Date Email -->
                    <td><?= $info["email"] ?></td>       
                    
                    <!-- Field Package -->
                    <td title="Click to Select Package" 
                      style="cursor:pointer;color:red;font-weight:bolder" 
                      class="text-center select-package 
                      btnSelectPackage"
                      data-toggle="modal" 
                      data-target="#modal-package" 
                      inquiryid="<?= $info['main_id']; ?>"
                      selecteddate=<?= $info['expected_date']; ?>>
                      <span style="color:green;font-weight:bolder;"><?= $info["package"] ?></span>
                    </td>
                    <!-- Field room # -->
                    <td><?= $info["room_no"] ?></td> 

                    <!-- Field Person -->
                    <td><?= $info["person"] ?></td> 
                    <!-- Field Person -->
                    <td><?= $info["customer_price"] ?></td> 
                    <!-- Field Message -->
                    <td><?= $info["message"] ?></td>       
                    
                    <!-- Field Expected Date -->
                    <td><?= $info["expected_date"] ?></td>       
                    
                    <!-- Field Remarks -->
                    <td>
                      <?php if ($info["userid"] == 1): ?>
                        <span title="Admin Edited this" style="color:	#ffff ;font-weight:bolder;border:#FF5733 solid 2px;border-radius:6px;padding:5px;background:#C70039;">Admin</span>
                      <?php elseif ($info["userid"] == 2): ?>
                        <span title="Secretary Edited this" style="color:	#ffff ;font-weight:bolder;border:#714D07  solid 2px;border-radius:6px;padding:5px;background:#F3A60C;">Secretary</span>
                      <?php else: ?>
                        <span title="Not Edited" style="color:red;font-weight:bolder;border:#FF5733 solid 2px;border-radius:6px;padding:5px;background:#ffff;">None</span>
                      <?php endif ?>
                    </td>       
                    
                    <!-- Field Expected Date -->
                    <td><?= $info["date_update"] ?></td>   

                    <!-- Field Actions -->
                    <td>
                        <button title="Search Customer" class="btn btn-primary btn-sm btnSearchCustomer"                        
                        pangalan="<?= $info['inquiry_fullname'] ?>" 
                        inquiryid="<?= $info['main_id'] ?>"  
                        data-toggle="modal" data-target="#modal-search">
                        <i class="fas fa-search"></i>

                        </button>
                        <button class="btn btn-danger btn-sm btnDelete" 
                        deleteid = "<?= $info['main_id'] ?>"
                        title="Delete Inquiry"><i class="fas fa-trash-alt"></i></button>

                        <?php if ($info['customer_id'] > 0 && $info['package'] > 0): ?>
                          <button class="btn btn-success btn-sm btnApprove"  
                          inquiryid = "<?php echo $info['main_id'];?>"
                          title="Approve Inquiry"><i class="fas fa-check"></i></button>
                        <?php endif ?>
                        
                        <?php if (empty($info['customer_id'])): ?>
                          <button class="btn btn-warning btn-sm btnCreateAccInquiry"
                          inquiryid = "<?php echo $info['main_id']?>"
                          contact = "<?php echo $info['cpnumber']?>"
                          email = "<?php echo $info['email']?>"
                          data-toggle="modal"
                          data-target="#modal-createacc"
                          title="Create Account "><i class="fas fa-user-plus"></i></button>
                        <?php endif ?>

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
                    <th>Room #</th>
                    <th>Person</th>
                    <th>Person</th>
                    <th>Message</th>
                    <th>Expected Date</th>
                    <th>Remarks</th>
                    <th>Date Updated</th>
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