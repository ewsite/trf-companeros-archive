<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if ($_POST['room_no']) {
  $room_no = $_POST['room_no'];
  $sqlmanageroom = mysqli_query($con, "SELECT * FROM rooms WHERE room_no='$room_no'");
  $package = mysqli_fetch_assoc($sqlmanageroom);
  $price_lists = json_decode($package["price_list"], true);

?>
  <style>
    .col-3 {
      margin-top: 10px;
    }
  </style>

  <div class="col-3">
  </div>
  <script>
    function toggleReadOnly() {
      var inputs = document.querySelectorAll('input[type="text"]');
      var clearButton = document.getElementById('clearButton');
      for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].id !== 'prices') {
          inputs[i].readOnly = !inputs[i].readOnly;

        }
      }
      clearButton.disabled = !clearButton.disabled;
    }

    function clearInputText() {
      var inputs = document.querySelectorAll('input[type="text"]');
      for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].id !== 'prices') {
          inputs[i].value = '';
        }

      }
    }
  </script>
  <div class="card-body">
    <!-- <button class="btn btn-warning col-2" onclick="toggleReadOnly()">Read Only</button>
    <button class="btn btn-danger col-2" id="clearButton" onclick=" clearInputText()">Delete All</button> -->

    <div class="row" id="addinput">
      <form id="lyney">
        <?php foreach ($price_lists as $price_list): ?>
          <div class="form-group">
              <label><?= $price_list["duration"] ?> Hour Price:</label>
              <input class="form-control" type="number" name="<?= $price_list["duration"] ?>" value=<?=intval($price_list["price"])?>>
          </div>
        <?php endforeach ?>
      </form>
    </div>

  <?php
}

  ?>
  <script>
    var room_no = <?= $room_no ?>


  </script>
  <!-- <script src="plugins/jquery/jquery.min.js"></script> -->