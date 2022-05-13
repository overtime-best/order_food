<?php include('partials_front/header.php'); 
        if (isset($_POST['search'])) {
        $search = $_POST['search'];
        }
?>
<!-- Navbar Section Ends Here -->

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on Your Search <a href="#" class="text-white">' <?php echo $search;?> '</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <h3 class="text-center">
            <?php 
                if(isset($_SESSION['food'])) {
                    echo $_SESSION['food'];
                    unset($_SESSION['food']);
                }
            ?>
        </h3>
        <?php
        // echo $search;
        $sql = 'SELECT * FROM tbl_food WHERE food_title LIKE "%":f_sh"%"';
        $stat = $cont->prepare($sql);
        $stat->execute(['f_sh' => $search]);
        $c = $stat->rowCount();
        if ($c > 0) {
            while ($row  = $stat->fetch()) {
                $f_id    = $row['food_id'];
                $f_title = $row['food_title'];
                $f_desc  = $row['food_desc'];
                $f_price = $row['food_price'];
                $f_image = $row['food_imageName'];

        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php if ($f_image != "") {

                        ?>
                            <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php

                        } else {echo "<div>Image Is Not Avalible</div>";} ?>
                        
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $f_title;?></h4>
                        <p class="food-price"><?php echo "$".  $f_price;?></p>
                        <p class="food-detail">
                            <?php echo $f_desc; ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            $_SESSION['food'] = 'The Searched Element Didn/t Found';
        }

        ?>
        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<!-- social Section Starts Here -->
<section class="social">
    <div class="container text-center">
        <ul>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" /></a>
            </li>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png" /></a>
            </li>
        </ul>
    </div>
</section>
<!-- social Section Ends Here -->
<?php include('partials_front/footer.php'); ?>