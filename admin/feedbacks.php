<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      <div class="col-sm-6">

        <h1 class="m-0">Feedback</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Feedback</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>


<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List of Raw Feedbacks</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Customer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Comment</th>
                    <th>Date Sended</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = mysqli_query($con, "SELECT * FROM client_feed WHERE status='0'");
                  $i = 1;
                  while ($result = mysqli_fetch_assoc($sql)) {
                    # code...

                  ?>
                    <tr>
                      <td><?php echo $i . ".";
                          $i++; ?></td>
                      <td>
                        <?php
                          echo $result['client_id'];
                        ?>
                      </td>
                      <td>
                      <?php
                          echo $result['fname'];
                          ?>
                      </td>
                      <td>
                      <?php
                          echo $result['lname'];
                          ?>
                      </td>
                      <td>
                        <?php
                        echo $result['message'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['date_send'];
                        ?>
                      </td>
                      <td>
                          <button class="btn btn-success btnPostFeeds" title="Insert This Message"
                          clientid = "<?php echo $result['client_id'];?>"
                          lname = "<?php echo $result['lname'];?>"
                          message = "<?php echo $result['message'];?>"
                          datesend = "<?php echo $result['date_send'];?>"
                          email = "<?php echo $result['email'];?>"
                          feedid = "<?php echo $result['id'];?>"
                          >
                          <i class="fas fa-envelope"></i>
                          </button>
                          <button class="btn btn-danger btnDeleteFeeds" title="Delete" deleteid="<?php
                                                                                                echo $result['id'];
                                                                                                ?>" title="Delete Feed">
                          <i class="fas fa-solid fa-trash-alt"></i>
                          </button>
                      </td>
                    </tr>

                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                  <th class="text-center">#</th>
                    <th>Customer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Comment</th>
                    <th>Date Sended</th>
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
            <h3 class="card-title">List of Feedbacks show in Homepage</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Customer Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Comment</th>
                    <th>Date Sended</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = mysqli_query($con, "SELECT * FROM client_feed WHERE status='1'");
                  $i = 1;
                  while ($result = mysqli_fetch_assoc($sql)) {
                    # code...

                  ?>
                    <tr>
                      <td><?php echo $i . ".";
                          $i++; ?></td>
                      <td>
                        <?php
                          echo $result['client_id'];
                        ?>
                      </td>
                      <td>
                      <?php
                          echo $result['fname'];
                          ?>

                      </td>
                      <td>
                      <?php
                          echo $result['lname'];
                          ?>

                      </td>
                      <td>
                        <?php
                        echo $result['message'];
                        ?>
                      </td>
                      <td>
                        <?php
                        echo $result['date_send'];
                        ?>
                      </td>
                      <td>
                          <button class="btn btn-danger btnDeleteFeeds" title="Delete" deleteid="<?php
                                                                                                echo $result['id'];
                                                                                                ?>" title="Delete Feed">
                          <i class="fas fa-solid fa-trash-alt"></i>
                          </button>
                      </td>
                    </tr>

                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                  <th class="text-center">#</th>
                    <th>Customer Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Comment</th>
                    <th>Date Sended</th>
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

