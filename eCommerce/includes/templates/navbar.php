<?php
$pageTitle = "Login";

if (isset($_SESSION["user"])) {
    echo "welcome" . $_SESSION["user"] . " ";
    echo "<a href='profile.php'> My Profile </a>";
    echo "<a href='newadd.php'> Create Ad </a>";
    $status = checkUserStatus($_SESSION["user"]);
    if ($status == 1) {
        echo "Activate your Email";
    }
} else {
?>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a href="login.php">
                <span class="float-end">Login / Signup</span>
            </a>

        </div>
    </nav>
<?php
}
?>
<div class="">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach (getLatest("*", "categories", "catid", 100) as $cat) {
                                echo '<li><a class="dropdown-item" href="categories.php?pageid=' . $cat['catid'] . '&pagename=' . $cat['name'] . '">' . str_replace(' ', '-', $cat['name']) . "</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="items.php">Items</a>
                    </li>                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php ">Edit profile</a></li>
                            <li><a class="dropdown-item" href="../index.php">visit shop</a></li>
                            <li><a class="dropdown-item" href="logout.php">logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>