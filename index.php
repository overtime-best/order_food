    <?php include('partials_front/header.php'); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo HOME_URL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <div class="category-box just-content">
                <?php
                if (isset($_SESSION['food'])) {
                    echo  $_SESSION['food'];
                }
                //Create Sql Query To Get All Data From Database
                $sql = 'SELECT * FROM tbl_category WHERE cat_status = "yes" LIMIT 3 ';
                $stat = $cont->prepare($sql);
                $stat->execute();
                $c = $stat->rowCount();
                if ($c > 0) {

                    while ($row = $stat->fetch()) {
                        $c_id  =  $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        $cat_image = $row['cat_imageName'];


                ?>
                        <div class="box1 box_three">
                            <a href="<?php HOME_URL; ?>category-foods.php?cat_id=<?php echo $c_id; ?>">
                                <div class="box-3 float-container">
                                    <!-- Get Images From Databasse -->
                                    <?php if ($cat_image == "") {
                                        echo '<div>Image Not Available</div>';
                                    } ?>
                                    <div class="cat-image">
                                        <img src="<?php HOME_URL; ?>images/category_img/<?php echo $cat_image; ?>" alt="Pizza" class="img-responsive img-curve"style='height: 200px;'>
                                    </div>
                                    <!-- Get Title From Database -->
                                    <h3 class="float-text text-white" style="margin-left: 0px; bottom: -35px"><?php echo $cat_title; ?></h3>
                                </div>
                            </a>
                        </div>
                <?php
                    }
                } else {
                    echo "<div syle='margin: auto;'>Category Not Added</div>";
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="food-box">
                <?php
                // This In Order To Get Food Detials From Food Table In DataBase
                $sql = "SELECT * FROM tbl_food LIMIT 4";
                $stat = $cont->prepare($sql);
                $stat->execute();
                $cn = $stat->rowCount();
                if ($cn > 0) {
                    while ($row = $stat->fetch()) {
                        $f_id    = $row['food_id'];
                        $f_title = $row['food_title'];
                        $f_price = $row['food_price'];
                        $f_desc  = $row['food_desc'];
                        $f_image = $row['food_imageName'];
                ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php if ($f_image != "") {

                                ?>
                                    <img src="<?php echo HOME_URL ?>images/food_image/<?php echo $f_image; ?>">
                                <?php

                                } else {
                                    echo "<div>Image Is Not Avalible</div>";
                                } ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $f_title; ?></h4>
                                <p class="food-price"><?php echo "$" . $f_price; ?></p>
                                <p class="food-detail">
                                    <?php echo $f_desc; ?>
                                </p>
                                <br>

                                <a href="<?php echo HOME_URL; ?>order.php?food_id=<?php echo $f_id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div>There's No Food In This Section</div>";
                }
                ?>
            </div>
        </div>
        <p class="text-center">
            <a href="<?php echo HOME_URL; ?>foods.php">See All Foods</a>
        </p>
        <div class="clearfix"></div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials_front/footer.php'); ?>