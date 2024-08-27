<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Feedback</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Feedback</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="card card-info">
  <div class="card-header" style="background:#f8f9fa;">
    <h3 class="card-title" style="color:#ccc;">Feedback Form</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->

  <div class="card-body">

    <div class="form-group row">
      <textarea class="form-control" rows="3" placeholder="Message ..." style="resize: none;" id="feedback"></textarea>
    </div>

  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <button class="btn btn-primary" id="btn-send" customer_no=<?php echo $_SESSION['customer_no']; ?> lname=<?php echo $_SESSION['lname']; ?> fname=<?php echo $_SESSION['fname']; ?> email=<?php echo $_SESSION['email']; ?> contact=<?php echo $_SESSION['contact']; ?>>
      Send Feedback</button>
  </div>
  <!-- /.card-footer -->
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script>
  $("#btn-send").click(function() {
    var feedback = $('#feedback').val();
    customer_no = $(this).attr('customer_no');
    lname = $(this).attr('lname');
    fname = $(this).attr('fname');
    email = $(this).attr('email');
    contact = $(this).attr('contact');

    
    Swal.fire({
        title: "Reservation",
        html: "Please Wait :)",
        didOpen: () => {
          Swal.showLoading();
        }
    })
    if (feedback == '') {
      Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Empty Fields',
        color: '#000000',
        showConfirmButton: false,
        timer: 2000
      });
    } else {
      $.ajax({
        url: 'feedback-dash-process.php',
        method: 'POST',
        data: {
          feedback: feedback,
          customer_no: customer_no,
          lname: lname,
          fname: fname,
          email: email,
          contact: contact

        },
        success: function(response) {
          // alert(response);
          if (response == 'Success') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success',
                    html: 'Your feedback is appreciated to us!',
                    color: '#000000',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                      location.reload()
                    }
                });
              }
          else {
            Swal.fire({
              position: 'center',
              icon: 'warning',
              title: response,
              color: '#000000',
              showConfirmButton: false,
              timer: 2000
            });
          }
        }
      })
    }
  });
</script>