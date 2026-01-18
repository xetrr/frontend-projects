<?php
session_start();
$pageTitle = "Item Details";
include 'init.php';

$itemid = isset($_GET["itemid"]) && is_numeric($_GET["itemid"]) ? intval($_GET["itemid"]) : 0;
$stmt = $con->prepare("SELECT items.*,
                                categories.name AS category_name,
                                users.Username AS user_name,
                                users.Email AS user_email
                                FROM items
                                INNER JOIN categories
                                ON catid = cat_id
                                INNER JOIN users
                                ON user_id = member_id
                                WHERE item_id = ?");
$stmt->execute(array($itemid));
$row = $stmt->rowCount();
if ($row > 0) {
    $item = $stmt->fetch();
    
    // Get comments for this item
    $comments = getItemComments($itemid);
?>
    <div class="single-item-container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="categories.php?pageid=<?php echo $item['cat_id']; ?>&pagename=<?php echo urlencode(str_replace(' ', '-', $item['category_name'])); ?>"><?php echo htmlspecialchars($item['category_name']); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($item['name']); ?></li>
            </ol>
        </nav>

        <div class="single-item-hero">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="item-image-wrapper">
                        <img src="img.jpg" alt="<?php echo htmlspecialchars($item['name']); ?>" class="item-main-image">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="item-info">
                        <span class="item-category-badge"><?php echo htmlspecialchars($item['category_name']); ?></span>
                        <h1 class="item-main-title"><?php echo htmlspecialchars($item['name']); ?></h1>
                        <div class="item-price-section">
                            <span class="item-price">$<?php echo number_format($item['price'], 2); ?></span>
                        </div>
                        <div class="item-details-grid">
                            <div class="detail-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <div>
                                    <strong>Made In</strong>
                                    <p><?php echo htmlspecialchars($item['country_made']); ?></p>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fa fa-calendar"></i>
                                <div>
                                    <strong>Added Date</strong>
                                    <p><?php echo date('F j, Y', strtotime($item['add_date'])); ?></p>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fa fa-user"></i>
                                <div>
                                    <strong>Seller</strong>
                                    <p><?php echo htmlspecialchars($item['user_name']); ?></p>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fa fa-check-circle"></i>
                                <div>
                                    <strong>Status</strong>
                                    <p><?php echo ($item['status'] == 1) ? 'Available' : 'Unavailable'; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="item-details-section">
            <div class="row">
                <div class="col-lg-8">
                    <div class="detail-card">
                        <h3><i class="fa fa-info-circle"></i> Description</h3>
                        <p class="item-full-description"><?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
                    </div>

                    <!-- Comments Section -->
                    <div class="detail-card mt-4">
                        <h3><i class="fa fa-comments"></i> Comments (<?php echo count($comments); ?>)</h3>
                        <?php if (count($comments) > 0) { ?>
                            <div class="comments-list">
                                <?php foreach ($comments as $comment) { ?>
                                    <div class="comment-item">
                                        <div class="comment-header">
                                            <strong><?php echo htmlspecialchars($comment['user_name']); ?></strong>
                                            <span class="comment-date"><?php echo date('M j, Y g:i A', strtotime($comment['date'])); ?></span>
                                        </div>
                                        <p class="comment-text"><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="no-comments">
                                <i class="fa fa-comment-slash"></i>
                                <p>No comments yet. Be the first to comment!</p>
                            </div>
                        <?php } ?>

                        <!-- Add Comment Form -->
                        <?php if (isset($_SESSION['user'])) { ?>
                            <div class="add-comment-section mt-4">
                                <h4>Add a Comment</h4>
                                <form action="items.php?itemid=<?php echo $itemid; ?>" method="POST" class="comment-form">
                                    <div class="form-group">
                                        <textarea name="comment" class="form-control" rows="4" placeholder="Write your comment here..." required></textarea>
                                    </div>
                                    <button type="submit" name="add_comment" class="btn btn-primary">
                                        <i class="fa fa-paper-plane"></i> Post Comment
                                    </button>
                                </form>
                            </div>
                        <?php } else { ?>
                            <div class="login-prompt mt-4">
                                <p><a href="login.php">Login</a> to add a comment</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-card">
                        <h4><i class="fa fa-user-circle"></i> Seller Information</h4>
                        <div class="seller-info">
                            <p><strong>Username:</strong> <?php echo htmlspecialchars($item['user_name']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($item['user_email']); ?></p>
                        </div>
                        <a href="profile.php?username=<?php echo urlencode($item['user_name']); ?>" class="btn btn-outline-primary btn-block mt-3">
                            <i class="fa fa-user"></i> View Seller Profile
                        </a>
                    </div>

                    <div class="sidebar-card mt-4">
                        <h4><i class="fa fa-share-alt"></i> Share This Item</h4>
                        <div class="share-buttons">
                            <button class="btn btn-sm btn-outline-secondary" onclick="shareOnFacebook()">
                                <i class="fab fa-facebook"></i> Facebook
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" onclick="shareOnTwitter()">
                                <i class="fab fa-twitter"></i> Twitter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function shareOnFacebook() {
        const url = encodeURIComponent(window.location.href);
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, '_blank', 'width=600,height=400');
    }

    function shareOnTwitter() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('<?php echo htmlspecialchars($item['name'], ENT_QUOTES); ?>');
        window.open('https://twitter.com/intent/tweet?url=' + url + '&text=' + text, '_blank', 'width=600,height=400');
    }
    </script>

    <?php
    // Handle comment submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_comment']) && isset($_SESSION['user'])) {
        $commentText = $_POST['comment'];
        $userId = $_SESSION['ID'];
        
        if (!empty($commentText)) {
            $stmt = $con->prepare("INSERT INTO comments (item_id, member_id, comment, date, status) VALUES (?, ?, ?, NOW(), 0)");
            $stmt->execute([$itemid, $userId, $commentText]);
            header("Location: items.php?itemid=" . $itemid);
            exit();
        }
    }
    ?>

<?php } else { ?>
    <div class="container text-center py-5">
        <div class="empty-state">
            <i class="fa fa-exclamation-triangle" style="font-size: 64px; color: #f39c12;"></i>
            <h2 class="mt-4">Item Not Found</h2>
            <p class="text-muted">The item you're looking for doesn't exist or has been removed.</p>
            <a href="index.php" class="btn btn-primary mt-3">Go to Homepage</a>
        </div>
    </div>
<?php } ?>

<?php
include $tpl . 'footer.php';
?>