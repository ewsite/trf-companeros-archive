<?php

$sql = mysqli_query($con, "SELECT rooms.*, main_table.main_id, main_table.inquiry_fullname, main_table.fname, main_table.lname FROM main_table RIGHT JOIN rooms ON main_table.main_id = rooms.customer_id");
$rooms = $sql->fetch_all(MYSQLI_ASSOC);

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      <div class="col-sm-6">

        <h1 class="m-0">Room</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Room</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
  <div class="container-fluid h-100">
   <div class="row">
    <?php foreach($rooms as $room): ?>
        <div class="col-md-6">
            <div class="card h-100 
              <?php if ($room["occupied"]): ?>
                card-danger
              <?php elseif ($room["reserved"]): ?>
                card-warning
              <?php else: ?>
                card-success
              <?php endif ?>  
              ">
                <div class="card-header">
                    <h3>Room <?= $room["room_no"] ?></h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">

                        <?php if ($room["occupied"]): ?>
                          <p>Status: <b>Occupied</b></p>
                          <b>Occupied By: <?= !strlen($room["inquiry_fullname"]) ? $room['fname'].' '.$room['lname']: $room["inquiry_fullname"] ?></b>
                        <?php elseif ($room["reserved"]): ?>
                          <p>Status: <b>Reserved</b></p>
                          <b>Reserved By: <?= !strlen($room["inquiry_fullname"]) ? $room['fname'].' '.$room['lname']: $room["inquiry_fullname"] ?></b>
                        <?php endif ?>
                    </div>
                    
                    <?php if ($room["occupied"]): ?>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <button roomno="<?= $room["room_no"] ?>" mainid="<?= $room["main_id"] ?>" class="btn btn-danger kick">Set as Unoccupied</button>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>

   </div>
  </div>
</div>

<script src="/assets/js/room.js" defer></script>