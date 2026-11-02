<?php
session_start();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "12345"){

        $_SESSION['admin'] = true;

        header("Location: dashboard.php");
    }
    else{
        $error = "Invalid Login!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container">

<div class="row justify-content-center align-items-center vh-100">

<div class="col-lg-4">

<div class="tracking-box">

<h3 class="mb-4 text-center">Admin Login</h3>

<?php
if(isset($error)){
    echo "<p class='text-danger'>$error</p>";
}
?>

<form method="POST">

<input type="text"
name="username"
class="form-control mb-3"
placeholder="Username">

<input type="password"
name="password"
class="form-control mb-3"
placeholder="Password">

<button class="btn custom-btn w-100"
name="login">

Login

</button>

</form>

</div>

</div>

</div>

</div>

</body>
</html>