<?php include 'init.php'; ?>

<div class="container" style="padding: 40px 20px;">
    <div class="category-header text-center mb-5">
        <h1 class="category-title"><?php echo isset($_GET["pagename"]) ? htmlspecialchars(str_replace('-', ' ', $_GET["pagename"])) : 'Category'; ?></h1>
        <p class="category-subtitle">Browse our collection of <?php echo isset($_GET["pagename"]) ? htmlspecialchars(strtolower(str_replace('-', ' ', $_GET["pagename"]))) : 'category'; ?> items</p>
    </div>

    <?php
    // get the catID
    $catid = isset($_GET["pageid"]) && is_numeric($_GET["pageid"]) ? intval($_GET["pageid"]) : '0';
    $items = getItemsFromCategory('*', $catid);
    if (!$items) {
    ?>
        <div class="empty-state text-center py-5">
            <div class="empty-icon mb-4">
                <i class="fa fa-box-open" style="font-size: 64px; color: #ccc;"></i>
            </div>
            <h2 class="mb-3">No Items in this Category</h2>
            <p class="text-muted mb-4">Be the first to add an item to this category!</p>
            <?php if (isset($_SESSION['user'])) { ?>
                <a href="newadd.php" class="btn btn-primary btn-lg">
                    <i class="fa fa-plus"></i> Add New Item
                </a>
            <?php } else { ?>
                <a href="login.php" class="btn btn-primary btn-lg">Login to Add Item</a>
            <?php } ?>
        </div>
    <?php
    } else {
    ?>
        <div class="items-grid">
            <?php foreach ($items as $item) { ?>
                <div class="modern-item-card">
                    <div class="card-image">
                        <img src="img.jpg" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <span class="price-badge">$<?php echo number_format($item['price'], 2); ?></span>
                        <?php if (isset($item['status']) && $item['status'] == 1) { ?>
                            <span class="status-badge">Available</span>
                        <?php } ?>
                    </div>
                    <div class="card-content">
                        <h3 class="item-title"><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p class="item-description"><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="item-meta">
                            <span><i class="fa fa-map-marker-alt"></i> <?php echo htmlspecialchars($item['country_made']); ?></span>
                            <span><i class="fa fa-user"></i> <?php echo htmlspecialchars($item['user_name']); ?></span>
                        </div>
                        <a href="items.php?itemid=<?php echo $item['item_id']; ?>" class="view-details-btn">
                            <i class="fa fa-eye"></i> View Details
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<?php
include $tpl . 'footer.php';
?>