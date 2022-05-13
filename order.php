<?php include('partials_front/header.php'); ?>
<!-- Navbar Section Ends Here -->

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" class="order" method="POST">
            <fieldset>

                <legend>Selected Food</legend>
                <?php
                 if (isset($_GET['food_id'])) {
                     $id =  $_GET['food_id'];
                 }
                $sql = 'SELECT * FROM tbl_food WHERE food_id = :f_id';
                $stat = $cont->prepare($sql);
                $stat->execute(['f_id' => $id]);
                $c = $stat->rowCount();
                if ($c > 0) {
                    while ($row = $stat->fetch()) {
                        $food_title = $row['food_title'];
                        $food_price = $row['food_price'];
                        $food_image = $row['food_imageName'];
                ?>
                        <div class="food-menu-img">
                            <?php
                               if($food_image != "") {
                                ?>
                                <img src="<?php echo HOME_URL?>images/food_image/<?php echo $food_image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">;
                                <?php
                               } else {
                                  echo "<div class='text-center'>Ther's No Selected Image</div>";
                               }
                            ?>
                        </div>
                        
                        <div class="food-menu-desc">
                            <h3><?php echo $food_title;?></h3>
                            <p class="food-price"><?php echo $food_price;?></p>
                            <input type="hidden" name="food_title" value="<?php echo $food_title;?>">
                            <input type="hidden" name="food_price" value="<?php echo $food_price;?>">
                            <div class="order-label">Quantity</div>
                            <input type="number" name="qty" class="input-responsive" value="1" required>

                        </div>
                <?php
                    }
                }
                
                ?>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        if (isset($_POST['submit'])) {

            $order_title = $_POST['food_title'];
            $order_price = $_POST['food_price'];
            $order_qte   = $_POST['qty'];
            $order_total = $order_price * $order_qte;
            $order_date  = date('y-m-d h:i:sa');
            $order_status = "orderd";
            $custom_name  = $_POST['full-name'];
            $custom_contact = $_POST['contact'];
            $custom_email = $_POST['email'];
            $custom_address = $_POST['address'];

            $sql1 = "INSERT INTO tbl_order(order_food,
               order_price,
               order_qte, 
               order_total,
               order_date, 
               status, 
               customer_name, 
               customer_contact, 
               customer_email, 
               customer_address)

               VALUES(:ord_title, 

                :ord_price,
                :ord_qte, 
                :ord_total, 
                :ord_date, 
                :ord_status, 
                :cust_name, 
                :cust_contact,
                :cust_email,
                :cust_address)";
            $stat1 = $cont->prepare($sql1);
            $stat1->execute(['ord_title' => $order_title,
             'ord_price'    => $order_price,
             'ord_qte'      => $order_qte,
             'ord_total'    => $order_total, 
             'ord_date'     => $order_date,
             'ord_status'   => $order_status,
             'cust_name'    => $custom_name,
             'cust_contact' => $custom_contact, 
             'cust_email'   => $custom_email, 
             'cust_address' => $custom_address]);
             $count1 = $stat1->rowCount();
            if ($count1 > 0) {
                echo "<div class='text-center'>The Data Inderted Sucessfully</div>";
            } else{
                echo "Failed To Insert Data";
            }
        }

        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<!-- footer Section Starts Here -->
<?php include('partials_front/footer.php'); ?>