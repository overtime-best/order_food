<?php include('partials_front/header.php'); ?>
<!-- fOOD sEARCH Section Ends Here -->
<?php

if (isset($_GET['cat_id'])) {
    $id = $_GET['cat_id'];

$sql = 'SELECT * FROM tbl_category WHERE cat_id  = :ca_id';
$stat = $cont->prepare($sql);
$stat->execute(['ca_id' => $id]);
$count = $stat->rowCount();
if ($count > 0) {
    while ($row = $stat->fetch()) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
    }
    $_SESSION['welcome'] = 'welcome MR Mohy';
} else {
    $_SESSION['welcome'] = 'Error';
}
}
?>


<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <h2 class="text-center" style="background-image: url('images/bg.jpg');background-size: cover;
    background-repeat: no-repeat;
    background-position: center;height: 
    140px;position: relative;top: -70px;
     padding-top: 70px
     ">Foods on Your Search <a href="#" class="text-white">"<?php echo $cat_title;?>"</a></h2>
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        $sql1 = 'SELECT * FROM tbl_food WHERE cat_id = :c_cid';
        $stat1 = $cont->prepare($sql1);
        $stat1->execute(['c_cid' => $id]);
        $c1 = $stat1->rowCount();
        if ($c1 > 0) {
            $_SESSION['w'] = 'welcome';
            while ($row = $stat1->fetch()) {

                $f_id = $row['food_id'];
                $food_title = $row['food_title'];
                $food_desc = $row['food_desc'];
                $food_price = $row['food_price'];
                $food_image = $row['food_imageName'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="<?php echo HOME_URL?>images/food_image/<?php echo $food_image;?>" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $food_title;?></h4>
                        <p class="food-price"><?php echo $food_price ?></p>
                        <p class="food-detail">
                            <?php echo $food_desc;?>
                        </p>
                        <br>

                        <a href="<?php echo HOME_URL?>order.php?food_id=<?php echo $f_id;?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

        <?php
            }
        } else {
            echo "<div class='text-center'> Ther's No Food Based On Category Id </div>";
        }
        ?>

        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<!-- social Section Starts Here -->
<?php include('partials_front/footer.php'); ?>