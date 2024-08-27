<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

$room_package_1_res = mysqli_query($con, "SELECT * from rooms WHERE package_no = 1");
$room_package_2_res = mysqli_query($con, "SELECT * from rooms WHERE package_no = 2");
$room_package_3_res = mysqli_query($con, "SELECT * from rooms WHERE package_no = 3");

$room_package_1 = mysqli_fetch_all($room_package_1_res, MYSQLI_ASSOC);
$room_package_2 = mysqli_fetch_all($room_package_2_res, MYSQLI_ASSOC);
$room_package_3 = mysqli_fetch_all($room_package_3_res, MYSQLI_ASSOC);

$rooms = [];

array_push($rooms, [ "package_no" => 1, "rooms" => $room_package_1 ]);
array_push($rooms, [ "package_no" => 2, "rooms" => $room_package_2 ]);
array_push($rooms, [ "package_no" => 3, "rooms" => $room_package_3 ]);


$room_items = 3;

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      <div class="col-sm-6">

        <h1 class="m-0">Packages</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Packages</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
  <div class="container-fluid h-100">
    <?php foreach($rooms as $package): ?>
      <div class="row">
        <div class="col">
          <h3>Package <?= $package["package_no"] ?></h3>
        </div>
      </div>
      <div class="row">
        <?php 
          foreach($package["rooms"] as $room): 
        ?>
        <div class="col-md-4">
          <!-- Package 1 -->
          <div class="card card-row card-secondary">
            <div class="card-header">
              <h3 class="card-title">
                Room <?=$room["room_no"] ?>
              </h3>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btnModalManagePackage"
                    data-toggle="modal" data-target="#modal-editmanagepackage"
                    roomno="<?=$room["room_no"] ?>"
                    >
                      Edit
                </button>
            </div>
          </div>
        </div>
        <?php endforeach ?>
    </div>
    <?php endforeach ?>
  </div>
</div>