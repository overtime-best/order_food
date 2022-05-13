<?php include('partials_front/header.php'); ?>
<!-- Navbar Section Ends Here -->



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <div class="category-box">
            <?php
            //Create Sql Query To Get All Data From Database
            $sql = 'SELECT * FROM tbl_category WHERE cat_status = "yes"';
            $stat = $cont->prepare($sql);
            $stat->execute();
            $c = $stat->rowCount();
            if ($c > 0) {

                while ($row = $stat->fetch()) {
                    $c_id    = $row['cat_id'];
                    $c_title = $row['cat_title'];
                    $c_image = $row['cat_imageName'];
            ?>
                    <div class="box1">
                        <a href="<?php echo HOME_URL; ?>category-foods.php?cat_id=<?php echo $c_id; ?>">
                            <div class="box-3 float-container">
                                <!-- Get Images From Databasse -->

                                <?php if ($c_image == "") {
                                    echo '<div>Image Not Available</div>';
                                } else { ?>
                                    <div class="image">
                                        <img src="<?php HOME_URL; ?>images/category_img/<?php echo $c_image; ?>" alt="Pizza" class="img-responsive img-curve">
                                    </div>
                                <?php }

                                ?>
                                <!-- Get Title From Database -->
                                <h3 class="float-text text-white"><?php echo $c_title; ?></h3>
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


<!-- social Section Starts Here -->
<?php include('partials_front/footer.php'); ?>