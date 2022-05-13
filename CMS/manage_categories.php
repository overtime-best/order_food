<?php include('includes/templates/header.php'); ?>
    <!-- Navbar Section Ends Here -->

    <!-- Start Main-Content -->
    <div class="main-content">
        <div class="container">
            <h1 style="margin: 50px auto; text-align: center; color: #FFF">Mage Categories</h1>
            <div>
             <?php
                if (isset($_SESSION['add_cat'])) {
                    
                    echo '<h4 class="session-msg">' . $_SESSION['add_cat'] . '</h4>';
                    unset ($_SESSION['add_cat']);
                }
                if (isset($_SESSION['edit_cat'])) {

                    echo '<h4 class="session-msg">' . $_SESSION['edit_cat'] . '</h4>';
                    unset ($_SESSION['edit_cat']);
                }
                if (isset($_SESSION['delete_cat'])) {
                    
                    echo '<h4 class="session-msg">' . $_SESSION['delete_cat'] . '</h4>';
                    unset ($_SESSION['delete_cat']);
                }
            ?>
            </div>
            <button class="button"  style="margin-left: 160px">
                <h3><a href="add_cat.php">Add Category</a></h3>
            </button>
            <div class="wrapper">
            <table class="admin">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tilte</th>
                        <th>Image Name</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $id = 1;
                        $sql = "SELECT * FROM tbl_category";
                        $stat = $cont->prepare($sql);
                        $stat->execute();
                        $id = 1;
                        while($row = $stat->fetch()) {
                            $cat_id = $row['cat_id'];
                            ?><tr>
                                <td><?php echo $id++;?></td>
                                <td><?php echo $row['cat_title'];?></td>
                                <td>
                                    
                                <?php
                                    
                                    if ($row['cat_imageName'] != "") { ?>
                                         <img src="<?php echo HOME_URL;?>images/category_img/<?php echo $row['cat_imageName'];?>" style="width: 100px; height: 70px">

                                    <?php } else {echo "No Image Selected";}
                                ?>
                            
                            </td>
                                <td><?php echo $row['cat_featured'];?></td>
                                <td><?php echo $row['cat_status'];?></td>
                                <td class="edit"><a class="btn-primary" href="edit_cat.php?id=<?php echo $cat_id?>"> Edit Category</a></td>
                                <td class="delete">
                                <a class="btn-primary" href="delete_cat.php?id=<?php echo $cat_id?>&cat_image=<?php
                                    echo $row['cat_imageName'];
                                ?>">Delete Category</a>
                            </td>
                            </tr>

                       <?php  }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>