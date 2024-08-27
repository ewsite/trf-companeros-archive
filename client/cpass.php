<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      <div class="col-sm-6">
        <h1>Change Password
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Change Password


          </li>
        </ol>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<div class="card card-info">
  <div class="card-header" style="background:#f8f9fa;">
    <h3 class="card-title" style="color:#ccc;">Change Password Form


    </h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->

  <div class="card-body" style="margin:20px;">

    <div class="form-group">
      <label for="inputoldpass">Old Password</label>
      <input type="text" class="form-control" id="oldpass" placeholder="Enter Old Password">
    </div>
    <div class="form-group">
      <label for="inputnewpass">New Password</label>
      <input type="text" class="form-control" id="newpass" placeholder="Enter New Password">
    </div>
    <div class="form-group">
      <label for="inputretypenewpass">Retype New Password</label>
      <input type="text" class="form-control" id="retypepass" placeholder="Enter Retype New Password">
    </div>

  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <button type="submit" id="btn-confirm" class="btn btn-primary btnChange Confirm" customer_no=<?php echo $_SESSION['customer_no']; ?>
    email=<?php echo $_SESSION['email']; ?>>
      Confirm</button>
  </div>
  <!-- /.card-footer -->

</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>
  $("#btn-confirm").click(function() {
    var oldpass = $('#oldpass').val();
    var newpass = $('#newpass').val();
    var retypepass = $('#retypepass').val();
    customer_no = $(this).attr('customer_no');
    // email = $(this).attr('email');

    if (oldpass == '') {
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Empty Old Password',
        color: '#00000',
        showConfirmButton: false,
        timer: 2000
      });
    } else if (newpass == '') {
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Empty New Password',
        color: '#00000',
        showConfirmButton: false,
        timer: 2000
      });
    } else if (retypepass == '') {
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Empty New Retype Password',
        color: '#00000',
        showConfirmButton: false,
        timer: 2000
      });
    } else if (newpass.length < 8) {
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Password must be at least 8 characters long',
        color: '#00000',
        showConfirmButton: false,
        timer: 2000
      });
    } else {
      $.ajax({
        url: 'change-dash-process.php',
        method: 'POST',
        data: {
          oldpass: oldpass,
          newpass: newpass,
          retypepass: retypepass,
          customer_no: customer_no
        },
        success: function(response) {
          // alert(response);
          if (response == 'Old Password is Incorrect') {
            Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'Old Password is Incorrect',
              color: '#00000',
              showConfirmButton: false,
              timer: 2000
            });
          }else if(response == 'New password and confirm password do not match'){
            Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'New Password and Confirm Password Do Not Match',
              color: '#00000',
              showConfirmButton: false,
              timer: 2000
            });
          }else if(response == 'Password Updated Successfully'){
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Password Updated Successfully',
              color: '#00000',
              showConfirmButton: false,
              timer: 2000
            });
            setTimeout(function() {
               
            }, 2000)
          }
        }
      })
    }
  });
</script>