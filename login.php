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
    <title>Login | TRF Hotel- Campaňeros Hotel </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
   
    <script src="/plugins/jquery/jquery-3.7.1.min.js"></script>
    <link href="/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <script src="/plugins/sweetalert2/sweetalert2.all.min.js" defer></script>
    <script src="/assets/js/login.js" defer></script>
</head>
<body class="darkbg">
    <div class="container d-flex justify-content-center" style="height: 100vh">
        <div class="row w-100">
            <div class="col-md-6 bg-light p-4 rounded">
                <form action="post" class="w-100">
                    <div class="mb-3">
                        <h2>Login</h2>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <button class="btn  btn-primary" type="submit">Login</button>
                    </div>
                    <div class="mb-3">
                        No account? Just <a href="/signup.php">Sign Up</a>
                    </div>
                </form>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</body>
</html>