<?php


require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";


$loggedIn = isset($_SESSION["customer_no"]);

if ($loggedIn) {
    header("Location: /");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>Sign Up | TRF Hotel- Campaňeros Hotel </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
   
    <script src="/plugins/jquery/jquery-3.7.1.min.js"></script>
    <link href="/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <script src="/plugins/sweetalert2/sweetalert2.all.min.js" defer></script>

    <script src="/assets/js/signup.js" defer></script>
</head>
<body class="darkbg">
    <div class="container d-flex justify-content-center" style="height: 100vh">
        <div class="row w-100 h-75 relative">
            <div class="col-md-6 bg-light p-4 h-100 overflow-auto rounded overflow-auto">
            <form method="post">
                <div class="mb-3">
                    <h3>Sign Up</h3>
                    <b>NOTE: Make sure the information are correct</b>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="fname" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" name="lname" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Contact Number</label>
                    <input type="tel" class="form-control" placeholder="Contact" name="contact" maxlength="11" required>
                </div>
                
                <div class="mb-3">
                    <label for="" class="form-label">Email Address</label>
                    <input type="email" class="form-control" pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" placeholder="Email" name="email" required>
                </div>
               
                <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="user" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
               
                <div class="mb-3">
                    <label for="" class="form-label"></label>
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                </div>
               
                <div class="mb-3">
                    <label for="" class="form-label"></label>
                    <button type="submit" class="btn btn-success">Sign Up</button>
                </div>
               
            </form>
            <p>Already have an account? <a href="/login.php">Login</a></p>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</body>
</html>