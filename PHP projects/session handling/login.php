<?php
include('config.php');
session_start();
if (isset($_POST["submit"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $select_data = "SELECT * FROM `user_from` WHERE email ='$email' AND password = '$password'";
    $select = mysqli_query($conn, $select_data);
    if (mysqli_num_rows($select) > 0) {
        $row =  mysqli_fetch_assoc($select);
        $_SESSION["user_id"] = $row['id'];
        header('location:home.php');
    } else {

        $message[] = 'login failed';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
            <a class="nav-link active" aria-current="page" href="register.php">register</a>
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
                <h3>login</h3>
                <?php
                if (isset($message)) {

                    foreach ($message as $message) {
                        echo "<div class= 'message'>$message</div>";
                    }
                }

                ?>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Enter email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Enter password" name="password" required>
                </div>
                <p>sign up <a href="register.php">sign up</a></p>


                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </center>
</body>

</html>