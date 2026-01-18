<?php
ob_start();
session_start();
$pageTitle = "Login";

if (isset($_SESSION["user"])) {
    header("location: dashboard.php"); //if logged in >> go to dashboard
    exit();
}

include 'init.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include connect.php for database connection
    include 'admin/connect.php';

    // Check if this is a signup or login request
    $formType = isset($_POST["form_type"]) ? $_POST["form_type"] : 'login';

    if ($formType == 'signup') {
        // ========== SIGNUP PROCESSING ==========
        $signupError = '';
        $signupSuccess = '';

        // Validate and sanitize input
        $username = isset($_POST["signup_username"]) ? trim($_POST["signup_username"]) : '';
        $email = isset($_POST["signup_email"]) ? trim($_POST["signup_email"]) : '';
        $password = isset($_POST["signup_password"]) ? $_POST["signup_password"] : '';
        $fullName = isset($_POST["signup_fullname"]) ? trim($_POST["signup_fullname"]) : '';

        // Input validation
        if (empty($username) || empty($email) || empty($password) || empty($fullName)) {
            $signupError = 'Please fill in all fields.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $signupError = 'Please enter a valid email address.';
        } elseif (strlen($username) < 3) {
            $signupError = 'Username must be at least 3 characters long.';
        } elseif (strlen($password) < 4) {
            $signupError = 'Password must be at least 4 characters long.';
        } else {
            // Check if username already exists
            $usernameCheck = checkItem('Username', 'users', $username);
            if ($usernameCheck > 0) {
                $signupError = 'This username is already taken. Please choose another.';
            } else {
                // Check if email already exists
                $emailCheck = checkItem('Email', 'users', $email);
                if ($emailCheck > 0) {
                    $signupError = 'This email is already registered. Please use another email or login.';
                } else {
                    $hashedpass = sha1($password);
                    try {
                        $stmt = $con->prepare("INSERT INTO users(Username, Password, Email, FullName, RegStatus, Date) 
                                               VALUES(:user, :password, :email, :name, 1, NOW())");
                        $stmt->execute([
                            'user' => $username,
                            'password' => $hashedpass,
                            'email' => $email,
                            'name' => $fullName
                        ]);

                        if ($stmt->rowCount() > 0) {
                            $signupSuccess = 'Registration successful! You can now login.';
                            // Clear form data on success
                            $_POST = array();
                        } else {
                            $signupError = 'Registration failed. Please try again.';
                        }
                    } catch (PDOException $e) {
                        $signupError = 'Registration failed. Please try again later.';
                        // Log error in production instead of exposing it
                        error_log("Signup error: " . $e->getMessage());
                    }
                }
            }
        }
    } else {
        // ========== LOGIN PROCESSING ==========
        $loginError = '';

        // Validate and sanitize input
        $user = isset($_POST["user"]) ? trim($_POST["user"]) : '';
        $pass = isset($_POST["password"]) ? $_POST["password"] : '';

        // Input validation
        if (empty($user) || empty($pass)) {
            $loginError = 'Please enter both username and password.';
        } else {
            $hashedpass = sha1($pass);

            try {
                $stmt = $con->prepare("SELECT * FROM users WHERE Username = ? AND Password = ?");
                $stmt->execute(array($user, $hashedpass));
                $row = $stmt->fetch();
                $count = $stmt->rowCount();

                if ($count > 0) {
                    $_SESSION["user"] = $user;
                    $_SESSION["ID"]   = $row['user_id'];
                    header("location: dashboard.php");
                    exit();
                } else {
                    $loginError = 'Invalid username or password.';
                }
            } catch (PDOException $e) {
                $loginError = 'Login failed. Please try again later.';
                // Log error in production instead of exposing it
                error_log("Login error: " . $e->getMessage());
            }
        }
    }
}



?>

<div class="container-sm login-page">
    <h3 class="text-center">
        <span class="selected" data-class="login">Login</span> |
        <span class="" data-class="signup">Signup</span>
    </h3>

    <!-- start login form  -->
    <form class="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="form_type" value="login">
        <?php if (isset($loginError) && !empty($loginError)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($loginError, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">user name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="user" aria-describedby="emailHelp" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
        </div>
        <button type="submit" class="btn btn-primary" value="login">Submit</button>
    </form>

    <!-- start signup form -->
    <form class="signup-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="form_type" value="signup">
        <?php if (isset($signupError) && !empty($signupError)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($signupError, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($signupSuccess) && !empty($signupSuccess)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($signupSuccess, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="signupUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="signupUsername" name="signup_username"
                value="<?php echo isset($_POST['signup_username']) ? htmlspecialchars($_POST['signup_username'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                aria-describedby="usernameHelp" required minlength="3">
            <div id="usernameHelp" class="form-text">Must be at least 3 characters long.</div>
        </div>
        <div class="mb-3">
            <label for="signupFullName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="signupFullName" name="signup_fullname"
                value="<?php echo isset($_POST['signup_fullname']) ? htmlspecialchars($_POST['signup_fullname'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                required>
        </div>
        <div class="mb-3">
            <label for="signupEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="signupEmail" name="signup_email"
                value="<?php echo isset($_POST['signup_email']) ? htmlspecialchars($_POST['signup_email'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="signupPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="signupPassword" name="signup_password"
                aria-describedby="passwordHelp" required minlength="6">
            <div id="passwordHelp" class="form-text">Must be at least 6 characters long.</div>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>
<?php
include $tpl . 'footer.php';
ob_end_flush();
?>