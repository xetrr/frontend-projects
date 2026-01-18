<?php
ob_start();

function getComments($userid)
{
    global $con;
    $stmt = $con->prepare("SELECT comments.*,
                                items.name AS item_name                                
                                FROM comments
                                INNER JOIN items
                                ON comments.item_id = items.item_id                             
                                WHERE comments.member_id= ?
        ");
    $stmt->execute(array($userid));
    $comments = $stmt->fetchAll();
    return $comments;
}
// fn to get the lastest records [users, Items , comments]
function getItem($where, $value)
{
    global $con;
    $stmt = $con->prepare("SELECT * FROM items WHERE $where=? ORDER BY item_id DESC");
    $stmt->execute(array($value));
    $row = $stmt->fetchAll();
    return $row;
}

// Get single item with full details including category and user info
function getSingleItem($itemId)
{
    global $con;
    $stmt = $con->prepare("SELECT items.*,
                                categories.name AS category_name,
                                users.Username AS user_name,
                                users.Email AS user_email
                                FROM items
                                INNER JOIN categories
                                ON items.cat_id = categories.catid
                                INNER JOIN users
                                ON items.member_id = users.user_id
                                WHERE items.item_id = ?");
    $stmt->execute(array($itemId));
    return $stmt->fetch();
}

// Get approved comments for a specific item
function getItemComments($itemId)
{
    global $con;
    $stmt = $con->prepare("SELECT comments.*,
                                users.Username AS user_name
                                FROM comments
                                INNER JOIN users
                                ON comments.member_id = users.user_id
                                WHERE comments.item_id = ? AND comments.status = 1
                                ORDER BY comments.date DESC");
    $stmt->execute(array($itemId));
    return $stmt->fetchAll();
}

// Add a new comment
function addComment($itemId, $memberId, $commentText)
{
    global $con;
    try {
        $stmt = $con->prepare("INSERT INTO comments (item_id, member_id, comment, date, status)
                                VALUES (?, ?, ?, NOW(), 0)");
        $stmt->execute(array($itemId, $memberId, $commentText));
        return array('success' => true, 'message' => 'Comment submitted successfully and pending approval');
    } catch (PDOException $e) {
        return array('success' => false, 'message' => 'Error submitting comment');
    }
}
function getLatest($select, $table, $order, $limit = 10)
{
    global $con;

    $getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit ");
    $getStmt->execute();
    $rows = $getStmt->fetchAll();
    return $rows;
}
// fn to get the Items from the database [users, Items , comments]

function getItemsFromCategory($select, $where,  $ordering = 'DESC')
{
    global $con;

    $getStmt = $con->prepare("SELECT items.*,
                                 users.Username AS user_name
                                 FROM items 
                                 INNER JOIN users
                                 ON users.user_id = items.member_id
                                 WHERE cat_id = $where
                                 ORDER BY cat_id $ordering 
                                 ");
    $getStmt->execute();
    $rows = $getStmt->fetchAll();
    return $rows;
}

// check user RegStatus

function checkUserStatus($user)
{
    global $con;
    $stmtx = $con->prepare("SELECT * FROM users WHERE Username = ? AND RegStatus = ?");
    $stmtx->execute(array($user, 0));
    $count = $stmtx->rowCount();
    return $count;
}

// title function that echos the page title in case the page
function getTitle(): void
{
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo 'Default';
    }
}

// prepare html tag
function pre($arg)
{
    return '<pre>' . print_r($arg) . '</pre>';
}

// redirction
function redirectHome($userMsg, $url = null, $seconds = 1)
{
    if ($url === null) {
        $url = 'index.php';
    } else {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
            $url = $_SERVER['HTTP_REFERER'];
        } else {
            $url = 'index.php';
        }
    }
    header("refresh:$seconds;url=$url");
    echo "<div class= 'alert alert-info'>$userMsg</div>";
    exit();
}

// function to check items in database
function checkItem($select, $from, $value)
{
    global $con;

    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

    $statement->execute([$value]);

    $count = $statement->rowCount();
    return $count;
}

// count the number of items  V1.0

function countItems($item, $table)
{
    global $con;

    $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

    $stmt2->execute();

    return $stmt2->fetchColumn();
}



// change all the select boxs in the website 
ob_end_flush();
