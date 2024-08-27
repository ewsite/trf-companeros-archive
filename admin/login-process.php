
<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php"; 
if (isset($_POST['username']) && isset($_POST['password'])) {
$user = $_POST['username'];
$pass = $_POST['password'];
$sql = mysqli_query($con, "Select * FROM user_admin WHERE username='$user' 
AND password='$pass'" );
if(mysqli_num_rows($sql) > 0){
    $result=mysqli_fetch_array($sql);
    $_SESSION['id']=$result['id'];
    $_SESSION['ticket']="ticket";
    $_SESSION['position']=$result['position'];
    echo "welcome";
}else{
    echo mysqli_num_rows($sql);
}
}
?>