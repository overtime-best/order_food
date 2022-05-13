<?php include('partials_front/header.php'); ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo HOME_URL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql = "SELECT * FROM tbl_food";
                $stat = $cont->prepare($sql);
                $stat->execute();
                $count = $stat->rowCount();
                if($count > 0) {
                    while($row = $stat->fetch()) {
                        $food_id    = $row['food_id'];
                        $food_title = $row['food_title'];
                        $food_desc  = $row['food_desc'];
                        $food_price = $row['food_price'];
                        $food_image = $row['food_imageName'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($food_image != "") { ?>
                                            <img src="<?php echo HOME_URL?>images/food_image/<?php echo $food_image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                       <?php } else {echo "There's No Image";}
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $food_title;?></h4>
                                    <p class="food-price"><?php echo "$" . $food_price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $food_desc;?>
                                    </p>
                                    <br>

                                    <a href="order.php?food_id=<?php echo $food_id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                       <?php

                    }
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
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->
    <?php include('partials_front/footer.php'); ?>