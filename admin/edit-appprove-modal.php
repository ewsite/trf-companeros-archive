<div class="alert" id="msg" role="alert">
  
</div>
<div class="form-group">
  <label>Date:</label>
  <div class="input-group date" data-target-input="nearest">
    <input type="date" class="form-control datetimepicker-input" id="petsa" min="
    <?php
    $date = date_create(date('Y-m-d H:i:s'));
    date_add($date, date_interval_create_from_date_string("2 days"));
    echo date_format($date, "Y-m-d");
    ?>">

  </div>
</div>
<div class="form-group">
  <label>Time:</label>

  <div class="input-group">
    <select name="" id="cbotime" class="btn btn-default">
      <option value="0">-Select-</option>
      <option value="1" class="btn-warning">Day</option>
      <option value="2" style="background-color:navy;color:#fff;">Night</option>
    </select>

  </div>
  <div class="form-group">
    <label>Package:</label>

    <div class="input-group">
      <select name="" id="cbopackage" class="btn btn-default">
        <option value="0">-Select-</option>
        <option value="1">Package 1</option>
        <option value="2">Package 2</option>
        <option value="2">Package 3</option>

      </select>

    </div>
  </div>






  <script src="plugins/jquery/jquery.min.js"></script>

  <script>
    $("#msg").hide();
    $("#petsa").change(function() {
      // alert("dawdwa");

      var datecheck = $('#petsa').val();
      $.ajax({
        url: 'date-check.php',
        method: "POST",
        data: {
          datecheck: datecheck
        },
        success: function(response) {
          var msg = $('#msg');
          msg.show();
          if (response == "Available") {
            msg.removeClass("alert-danger");
            msg.addClass("alert-success");

            msg.text("Available");
            $("#btnConfirm").prop("disabled", false);
            
          } else {
            msg.removeClass("alert-success");
            msg.addClass("alert-danger");
            msg.text("Unavailable");
            $("#btnConfirm").prop("disabled", true);
          }
        }
      })
    })
  </script>