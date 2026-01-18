<?php
ob_start();
session_start();
$pageTitle = "Create New Ad";
include 'init.php';

if (isset($_SESSION["user"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $formErrors = array();
        $name = strip_tags($_POST["name"]);
        $desc = strip_tags($_POST["desc"]);
        $price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_INT);
        $country = strip_tags($_POST["country"]);
        $status = filter_var($_POST["status"], FILTER_SANITIZE_NUMBER_INT);
        $category = filter_var($_POST["cat"], FILTER_SANITIZE_NUMBER_INT);
        echo $name;

        if (empty($formErrors)) {
            $stmt = $con->prepare("INSERT INTO items (name , description , price , add_date , status, country_made ,cat_id , member_id) VALUES (:name,  :desc, :price ,now() , :status,:country, :cat , :member)");
            $stmt->execute(array(
                'name' => $name,
                'desc' => $desc,
                'price' => $price,
                'country' => $country,
                'status' => $status,
                'cat' => $category,
                'member' => $_SESSION["ID"]
            ));
            echo "item added successfully";
        }
    }
?>
    <h1 class="text-center">Create New Ad</h1>
    <div class="create-ad block">
        <div class="container">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" class="form-horizontal ">
                                <div class="form-group form-group-lg row g-1 align-items-center mb-2">
                                    <label for="" class="col-sm-1 col-form-label">Item Name</label>
                                    <div class="col-sm-10 col-md-6">
                                        <input type="text" name="name" id="" class="form-control live-name" required="required">
                                    </div>
                                </div>
                                <div class="form-group form-group-lg row g-1 align-items-center mb-2">
                                    <label for="" class="col-sm-1 col-form-label">Description</label>
                                    <div class="col-sm-10 col-md-6">
                                        <input type="text" name="desc" id="" class="form-control live-desc"
                                            required="required">
                                    </div>
                                </div>
                                <div class="form-group form-group-lg row g-1 align-items-center mb-2">
                                    <label for="" class="col-sm-1 col-form-label">Price</label>
                                    <div class="col-sm-10 col-md-6">
                                        <input type="text" name="price" id="" class="form-control live-price"
                                            required="required">
                                    </div>
                                </div>
                                <div class="form-group form-group-lg row g-1 align-items-center mb-2">
                                    <label for="" class="col-sm-1 col-form-label">Made In</label>
                                    <div class="col-sm-10 col-md-6">
                                        <input type="text" name="country" id="" class="form-control"
                                            required="required">
                                    </div>
                                </div>
                                <div class="form-group form-group-lg row g-1 align-items-center mb-2">
                                    <label for="" class="col-sm-1 col-form-label">Status</label>
                                    <div class="col-sm-10 col-md-6">
                                        <select class="form-control" name="status" id="">
                                            <option value="0">...</option>
                                            <option value="1">New</option>
                                            <option value="2">Like New</option>
                                            <option value="3">Used</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-group-lg row g-1 align-items-center mb-2">
                                    <label for="" class="col-sm-1 col-form-label">categories</label>
                                    <div class="col-sm-10 col-md-6">
                                        <select class="form-control" name="cat" id="cat">
                                            <option value="0">...</option>
                                            <?php
                                            $stmt2 = $con->prepare("SELECT * FROM categories");
                                            $stmt2->execute();
                                            $cats = $stmt2->fetchAll();
                                            foreach ($cats as $cat) {
                                                echo "<option value=" . $cat['catid'] . ">" . $cat["name"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-group-lg row g-1 align-items-center">
                                    <div class="col-sm-offset-2 col-sm-10 col-md-6">
                                        <input type="submit" value="Add Item" id="" class="btn btn-primary mt-2">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-2 ">
                            <div class="card item-box live-preview" style="width: 14rem;">
                                <span class="price-tag">100</span>
                                <img class="card-img-top" src="img.jpg" alt="Card image cap">
                                <div class="card-body caption">
                                    <h5 class="card-title">Item Name</h5>
                                    <p class="card-text">Item discription</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php
            if (!empty($formErrors)) {
                foreach ($formErrors as $error) {
                    echo '<div class="alert alert-danger"' . $error . '</div>';
                }
            } ?>
        </div>

    </div>
    </div>
<?php
}

// Footer is already included in init.php, so no need to include it again
ob_end_flush();
