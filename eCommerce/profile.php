<?php
session_start();
$pageTitle = "Profile";

// Check if user is logged in BEFORE including init.php (which outputs HTML)
if (!isset($_SESSION["user"])) { // make sure user is logged in to preview the profile page
    header("location: login.php");
    exit();
}

include 'init.php';
$getUserStmt = $con->prepare("SELECT * FROM users WHERE Username=?");
$getUserStmt->execute(array($session_user));
$info = $getUserStmt->fetch();
    
$userAds = getItem('member_id', $info['user_id']);
$userComments = getComments($info['user_id']);

?>

<h3 class="text-center mt-5">My Profile</h3>
<div class="container mt-5">

    <div class="card item-box border-primary mb-3">
        <div class="card-header bg-primary text-white">My Information</div>
        <div class="card-body">

            Name: <?= htmlspecialchars($_SESSION["user"] ?? 'Guest') ?> <br>
            Email: <?= htmlspecialchars($info["Email"] ?? 'Guest') ?> <br>
            Full Name: <?= htmlspecialchars($info["FullName"] ?? 'Guest') ?> <br>
            Reg Date: <?= htmlspecialchars($info["Date"] ?? 'Guest') ?> <br>
        </div>
    </div>

    <div class="card item-box border-primary mb-3 profile-card">
        <div class="card-header bg-primary text-white">My Ads</div>
        <?php
        foreach ($userAds as $adv) { ?>
            <div class="card-body caption card-border">
                <h5 class="card-title">
                    <a href='items.php?itemid=<?= $adv['item_id'] ?> '> name : <?= $adv['name']; ?></a>

                </h5>
                <p class="card-text">
                    description: <?= $adv['description'] ?>
                </p>
                <p class="card-text">
                    price: <?= $adv['price'] ?>
                </p>
                <p class="card-text">
                    date: <?= $adv['add_date'] ?>
                </p>
                <p class="card-text">
                    status: <?= $adv['Approve'] == '0' ?  "Listed" :  "Approved"; ?>
                </p>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="card border-primary mb-3">
        <div class="card-header bg-primary text-white">My Comments</div>
        <?php
        foreach ($userComments as $comment) { ?>
            <div class="card-body card-border">
                <h5 class="card-title">
                    comment : <?= $comment['comment']; ?>
                </h5>
                <p class="card-text">
                    item: <?= $comment['item_name'] ?>
                </p>
                <p class="card-text">
                    date: <?= $comment['date'] ?>
                </p>
                <p class="card-text">
                    status: <?= $comment['status'] == '0' ?  "Pending" :  "Approved"; ?>
                </p>
            </div>
        <?php
        }
        ?>
    </div>

</div>
<?php
include $tpl . 'footer.php';
?>