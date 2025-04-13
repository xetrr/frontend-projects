<?php
include('config.php');
if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $cpassword = mysqli_real_escape_string($conn, $_POST["cpassword"]);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded/' . $image;
    $select_data = "SELECT * FROM `user_from` WHERE email ='$email' AND password = '$password'";
    $select = mysqli_query($conn, $select_data);
    if (mysqli_num_rows($select) > 0) {
        $message[] = 'user already exist';
    } else {
        if ($password != $cpassword) {
            $message[] = 'confirm password not matched';
        } elseif ($image_size > 2000000) {
            $message[]  = 'image size is too large!';
        } else {
            $insert = mysqli_query($conn, "INSERT INTO `user_from`(`name`, `email`, `password`, `image`) VALUES (' $name','$email','$password','$image')");
            if ($insert) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'registered successfully';
                header('location:login.php');
            } else {
                $message[] = 'registered failed';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-container {
            height: auto;
            width: 30%;
            margin: auto;
            margin-top: 200px;

        }

        .form-container form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 20px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>


    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="home.php">home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="edit.php">edit</a>
        </li>

    </ul>
    <center>
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>register now</h3>
                <?php
                if (isset($message)) {

                    foreach ($message as $message) {
                        echo "<div class= 'message'>$message</div>";
                    }
                }

                ?>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter username" name="name" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Enter email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Enter password" name="password" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="confirm password" name="cpassword" required>
                </div>
                <div class="form-group">
                    <input type="file" class="form-control" name="image" accept="image/jpg, image/jpeg, image/png">
                </div>
                <p>already have an account? <a href="login.php">login</a></p>


                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </center>
</body>

</html>