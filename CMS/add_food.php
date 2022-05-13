<?php include('includes/templates/header.php');?>
 
<div class="main-content">
    <div class="container">
        <div class="cat-box">
            <h3 style="margin: auto; text-align: center; color: #FFF">Add food</h3>
            <form class="cat-form" action="" method="POST" enctype="multipart/form-data">
                <!--multipart Allow you to upload data-->
                <table class="cat-tbl">
                    <tr>
                        <td>Title </td>
                        <td>
                            <input type="text" name="title" placeholder="Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>
                            <input type="text" name="desc" placeholder="desc">
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            <input type="text" name="price" placeholder="price">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Food Section</td>
                        <td>
                            <select name="food_category" id="">

                                <?php
                                $sql = "SELECT * FROM tbl_category WHERE cat_status = 'yes' ";
                                $stat1 = $cont->query($sql);
                                if ($stat1->rowCount() > 0) {

                                    while ($row = $stat1->fetch()) {
                                ?>
                                        <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; ?></option>
                                    <?php  }
                                } else {
                                    ?>
                                    <option value="<?php echo $row['0']; ?>"><?php 'No Category Found ! ' ?></option>

                                <?php }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input type="radio" name="featured" value="yes"> Yes
                            <input type="radio" name="featured" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Status </td>
                        <td>
                            <input type="radio" name="status" value="yes"> Yes
                            <input type="radio" name="status" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    $title      = $_POST['title'];
    $descript   = $_POST['desc'];

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != '') {
            $image_exe = explode('.', $image_name);
            $end_exe = end($image_exe);
            $image_name = 'food_' . rand(000, 999) . '.' . $end_exe;
            $image_path = $_FILES['image']['tmp_name'];
            $image_dest = '../images/food_image/' . $image_name;
            $move = move_uploaded_file($image_path, $image_dest);
            if ($move == true) {
               echo "Suceed";
            } else {
                $_SESSION['upload'] = 'Falied To Upload File';
            }
        } else {$image_name = '';}
    } else {$image_name = '';}
    $price    = $_POST['price'];
    $food_cat = $_POST['food_category'];
    if (isset($_POST['featured'])) {

        $featured = $_POST['featured'];
    } else {
        $featured = 'no';
    }

    if (isset($_POST['status'])) {

        $status = $_POST['status'];
    } else {
        $status  = 'no';
    }
    // Insert Data Into Food Table 


    $sql = "INSERT INTO tbl_food

    (food_title,food_desc, food_price,food_imageName, cat_id, food_featured, food_status)

    VALUES(:food_title, :food_desc, :food_price, :food_image, :cat_id, :food_featured, :food_status)";

    $stat2 = $cont->prepare($sql);
    $stat2->execute(
    ['food_title' => $title, 
    'food_desc' => $descript,
    'food_price' => $price,
    'food_image' => $image_name, 
    'cat_id' =>$food_cat,
    'food_featured' => $featured,
    'food_status' => $status]);


    $count = $stat2->rowCount();
    
    if($count > 0) {
     
        $_SESSION['insert'] = 'Insert Foods Sucessfully'; 

        ?>

      
        <script>
          window.location.href = '<?php echo HOME_URL ?>CMS/manage_foods.php';
        </script>

   <?php  }
}
?>