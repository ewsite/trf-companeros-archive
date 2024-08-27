<?php 


require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php 
                  $sqltotalamount = mysqli_query($con, "SELECT SUM(amountfor_fullpay) AS total_amount from main_table");
                  $result = mysqli_fetch_assoc($sqltotalamount);
                  $totalPayment = $result['total_amount'];
                  
                ?>
                <h3><sup style="font-size: 20px">₱</sup><?php echo $totalPayment;?></h3>
                <p>Total Full Payment</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
                  $sqltotalamount = mysqli_query($con, "SELECT SUM(amountfor_dppay) AS total_amount from main_table");
                  $result = mysqli_fetch_assoc($sqltotalamount);
                  $totalDpPayment = $result['total_amount'];
                  
                ?>
                <h3><sup style="font-size: 20px">₱</sup><?php echo $totalDpPayment;?></h3>
                <p>Total Downpayments</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php 
                  $sqltotaluser = mysqli_query($con, "SELECT COUNT(id) AS total from user_accounts WHERE status = 1");
                  $result = mysqli_fetch_assoc($sqltotaluser);
                  $totalCount = $result['total'];
                  
                ?>
                <h3><?php echo $totalCount;?></h3>

                <p>User Accounts</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
           <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-default">
              <div class="inner">
              <?php 
                  $sqltotaluser = mysqli_query($con, "SELECT COUNT(main_id) AS total from main_table WHERE status='6'");
                  $result = mysqli_fetch_assoc($sqltotaluser);
                  $totalCount = $result['total'];
                  
                ?>
                <h3><?php echo $totalCount;?></h3>

                <p>Total Reserved</p>
              </div>
              <div class="icon">
                <i class="ion-ios-analytics" style="font-size: 60px;"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php 

                  $sqltotaluser = mysqli_query($con, "SELECT COUNT(main_id) AS total from main_table WHERE status='7'");
                  $result = mysqli_fetch_assoc($sqltotaluser);
                  $totalCount = $result['total'];
                  
                ?>
                <h3><?php echo $totalCount;?></h3>

                <p>Fully Paids</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>

    