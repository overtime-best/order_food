<?php include('includes/templates/header.php'); ?>
     <!-- Navbar Section Ends Here -->

     <!-- Start Main-Content -->
     <div class="main-content">
         <div class="container">
             <h1 class="main-header">Mange Foods</h1>
             <?php
                if (isset($_SESSION['insert'])) {
                    echo "<h3 class='session-msg'>" . $_SESSION['insert'] . "</h3>";
                    unset($_SESSION['insert']);
                }
                if (isset($_SESSION['delete_food'])) {
                    echo "<h3 class='session-msg'>" . $_SESSION['delete_food'] . "</h3>";
                    unset($_SESSION['delete_food']);
                }
                if (isset($_SESSION['upload_food'])) {
                    echo "<h3 class='session-msg'>" . $_SESSION['upload_food'] . "</h3>";
                    unset($_SESSION['upload_food']);
                }

                if (isset($_SESSION['remove_food'])) {
                    echo "<h3 tyle='text-align: center'>" . $_SESSION['remove_img'] . "</h3>";
                    unset($_SESSION['remove_food']);
                }
                ?>
             <button class="button">
                 <h3><a href="add_food.php">Add Food</a></h3>
             </button>
             <div class="wrapper">
                 <table class="admin">
                     <thead>
                         <tr>
                             <th>Id</th>
                             <th>Title</th>
                             <th>Description</th>
                             <th>Price</th>
                             <th>Image</th>
                             <!--<th>CatName</th>-->
                             <th>Featured</th>
                             <th>Status</th>
                             <th colspan="2">Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php

                            $sql = 'SELECT * FROM tbl_food';
                            $stat = $cont->prepare($sql);
                            $stat->execute();
                            $count = $stat->rowCount();
                            $id = 1;
                            if ($count > 0) {
                                while ($row = $stat->fetch()) {
                                    $food_id       = $row['food_id'];
                                    $food_title    = $row['food_title'];
                                    $food_desc     = $row['food_desc'];
                                    $food_price    = $row['food_price'];
                                    $food_image    = $row['food_imageName'];
                                    $cat_name      = $row['cat_id'];
                                    $food_featured = $row['food_featured'];
                                    $food_status   = $row['food_status'];
                            ?>
                                 <tr>
                                     <td><?php echo $id++; ?></td>
                                     <td><?php echo $food_title; ?></td>
                                     <td><?php echo $food_desc; ?></td>
                                     <td><?php echo $food_price; ?></td>
                                     <td>
                                         <?php
                                            if (isset($food_image)) {
                                            ?>
                                             <img src="<?php echo HOME_URL; ?>images/food_image/<?php echo $food_image; ?>" style="width: 100px; height: 70px">
                                         <?php
                                            } else {echo "There's No Image Selected";}
                                            ?>
                                     </td>
                                     <!--<td><?php echo $cat_name; ?></td>-->
                                     <td><?php echo $food_featured; ?></td>
                                     <td><?php echo $food_status; ?></td>
                                     <td class="edit">
                                         <a href="edit_food.php?id=<?php echo $food_id?>">Edit</a>
                                        </td>
                                     <td class="delete">
                                         <a href="delete_food.php?id=<?php echo $food_id?>&image=<?php echo $food_image;?>">
                                         Delete</a></td>
                                 </tr>
                             <?php }
                            } else {

                                ?>
                             <tr>
                                 <td colspan="10">There's No Data Inside Database</td>
                             </tr>
                         <?php }
                            ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

     <!-- End Main-Content -->



     <!-- social Section Starts Here -->
     <?php include('includes/templates/footer.php'); ?>