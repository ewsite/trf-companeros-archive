

<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (isset($_POST['customerno'])) {
    $customerno = $_POST['customerno'];
    $sqleditacc = mysqli_query($con, "SELECT * FROM user_accounts where customer_no = '$customerno'");
    $result = mysqli_fetch_assoc($sqleditacc); 

?>
<style>
    .password-toggle {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-40%);
    /* transform: translateX(-10%); */
    cursor: pointer;
  }
  .password-toggle i {
    font-size: 20px;
  }
</style>
<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">NOTE: Make sure the Customer update about editing his/her account</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputuser" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputuser" readonly placeholder="Username" value="<?php echo $result['user']?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputlname" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputlname" placeholder="Last Name" value="<?php echo $result['lname']?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputfname" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputfname" placeholder="First Name" value="<?php echo $result['fname']?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputpass" placeholder="Password" value="<?php echo $result['password']?>" >
                      <span class="password-toggle" onclick="togglePassword()">
                      <i class="fas fa-eye" id="toggle-icon"></i>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Re-Type Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputretypepass" placeholder="Re-Type Password" >
                    </div>
                  </div>
                  <div class="card-body">
                <div class="row">
                  <div class="col-5">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" oninput="restrictSpaces1(event);validateInput(this)" id="inputcontact" placeholder="Contact" value="<?php echo $result['contact']?>">
                  </div>
                  <div class="col-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="inputemail"placeholder="Email" value="<?php echo $result['email']?>">
                  </div>
                </div>
              </div>
                  
                </div>
                <!-- /.card-body -->
               
                <!-- /.card-footer -->
              </form>
            </div>
<?php
}
?>
<script>
  //eye function
  function togglePassword() {
    var passwordField = document.getElementById("inputpass");
    var toggleIcon = document.getElementById("toggle-icon");

    if (passwordField.type === "password") {
      passwordField.type = "text";
      toggleIcon.classList.remove("fas", "fa-eye");
      toggleIcon.classList.add("fas", "fa-eye-slash");
    } else {
      passwordField.type = "password";
      toggleIcon.classList.remove("fas", "fa-eye-slash");
      toggleIcon.classList.add("fas", "fa-eye");
    }
  }
  //FOR CONTACT restriction from text
  var numericInput1 = document.getElementById('inputcontact');
  // Listen for the 'input' event on the input field
  numericInput1.addEventListener('input', function(event) {
    // Remove any non-numeric characters using regex
    numericInput1.value = numericInput1.value.replace(/[^0-9]/g, '');
  });
  //for prevent spacing 
  function restrictSpaces1(event) {
    var input = event.target.value;
    var filteredInput = input.replace(/\s/g, ''); // Remove spaces
    event.target.value = filteredInput;
  }
  //for required prefix "09" for contact
  function validateInput(input) {
    const requiredPrefix = "09";
    const value = input.value;

    if (!value.startsWith(requiredPrefix)) {
      input.value = requiredPrefix; // Set the input value to the required prefix
    }
  }
  
</script>
