<?php
require '../config.php';
require BL . 'functions/validate.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password =  $_POST["password"];
        if (checkEmpty($email) && checkEmpty($password)) {
            if (isValidEmail($email)) {
                $check = getRow('admins', 'admin_email', $email);
                $check_password = password_verify($password, $check['admin_password']);
                if ($check_password) {
                    $_SESSION["admin_name"]  = $check['admin_name'];
                    $_SESSION["admin_email"]  = $check['admin_email'];
                    $_SESSION["admin_id"]  = $check['admin_id'];
                    header("location:" . BURLA . "index.php");
                } else {
                    echo "faild";
                }
            } else {
                $error_message = "Enter a valid email!";
            }
        } else {
            $error_message = "please fill all fields";
        }
    } ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="max-width: 400px; width: 100%;">

            <div class="mb-3"> <?php require BL . 'functions/messages.php'; ?></div>
            <h3 class="mb-3 text-center">Login</h3>
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>
                <div class="d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>