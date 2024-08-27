
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List of Customer Accounts</h1>
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
            <h3 class="card-title" style="color:green;font-weight:700;">List of User</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Date Created</th>
                    <th>Customer Number</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Remarks</th>
                    <th>Date Updated</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";;
                  // $status = array(2, 6, 7, 8);
                  // $statusValues = array_map('intval', $status);
                  // $statusList = implode(',', $statusValues);
                  $sql = mysqli_query($con, "SELECT * FROM user_accounts WHERE status='1'");
                  $i = 1;
                  while ($result = mysqli_fetch_assoc($sql)) {
                    # code...
                  ?>
                    <tr>
                      <td><?php echo $i . ".";
                          $i++; ?></td>
                      <td><?php
                          echo $result['date_created'];
                          ?>
                      </td>
                      <td>
                        <?php
                        // if ($result['customer_id']==0) {
                        //   echo '<span style="color:red;font-weight:bolder;">' . $result['inquiry_fullname'] . '</span>';                        
                        // }else{
                        //   echo '<span style="color:green;font-weight:bolder;">' . $result['inquiry_fullname'] . '</span>';                        
                        echo $result['customer_no'];
                        // }
                        ?>

                      </td>
                      <td>
                        <?php
                        echo $result['user'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['password'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['lname'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['fname'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['email'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['contact'];
                        ?>
                      </td>
                      <td>
                        
                        <?php if ($result['user_id'] == 1): ?>
                        <span style="color:	#ffff ;font-weight:bolder;border:#FF5733 solid 2px;border-radius:6px;padding:5px;background:#C70039;" title="The one who edited the customer accounts">Admin</span>
                        <?php elseif ($result['user_id'] == 2): ?>
                        <span style="color:	#ffff ;font-weight:bolder;border:#714D07  solid 2px;border-radius:6px;padding:5px;background:#F3A60C;">Secretary</span>
                        <?php else: ?>
                        <span style="color:	#ffff ;font-weight:bolder;border:#714D07  solid 2px;border-radius:6px;padding:5px;background:#F3A60C;">User</span>
                        <?php endif?>
                      </td>
                      <td>
                        <?php
                        echo $result['date_updated'];

                        ?>
                      </td>
                      
                      <td>
                    <button class="btn btn-primary btn-sm btnEditAcc" 
                      id="accountsedit" 
                      customerno = "<?php echo $result['customer_no']; ?>"        
                      lname="<?php echo $result['lname']; ?>"
                      fname="<?php echo $result['fname']; ?>"
                      user="<?php echo $result['user']; ?>"
                      pass="<?php echo $result['password']; ?>"
                      contact="<?php echo $result['contact']; ?>" 
                      email="<?php echo $result['email']; ?>" 
                      data-toggle="modal" data-target="#modal-edit"
                      title="Edit Account"> 
                      <i class="fas fa-edit"></i></button>
                      <?php
                        // $cid = $result['customer_id'];
                        // $img1 = $result['payment_one_img'];
                        // $or1 = $result['or_no1'];
                      ?>
                      <button class="btn btn-danger btn-sm btnDeleteAcc" 
                      id="accounts" 
                      deleteacc="<?php
                        echo $result['id'];
                      ?>" title="Delete Account">
                      <i class="fas fa-trash-alt"></i></button>
                      <?php
                        // $cid = $result['customer_id'];
                        // $img1 = $result['payment_one_img'];
                        // $or1 = $result['or_no1'];
                      ?>
                      </td>
                
                    </tr>

                  <?php

                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Date Created</th>
                    <th>Customer Number</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Contact</th>
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





