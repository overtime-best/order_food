<?php
 include('includes/templates/header.php');

if (isset($_GET['id'])) {
    $_id = $_GET['id'];
}

$sql1 = "SELECT * FROM tbl_food WHERE food_id = :food_id";
$stat1 = $cont->prepare($sql1);
$stat1->execute(['food_id' => $_id]);
$count1 = $stat1->rowCount();
if($count1 > 0) {
    while($row = $stat1->fetch()) {
        $food_id         = $row['food_id'];
        $food_title      = $row['food_title'];
        $food_desc       = $row['food_desc'];
        $food_price      = $row['food_price'];
        $current_image      = $row['food_imageName'];
        $current_id      = $row['cat_id'];
        $food_featured   = $row['food_featured'];
        $food_status     = $row['food_status'];


    }
} 

?>
<div class="main-content">
    <div class="container">
        <div class="cat-box">
            <h3 style="margin: auto; text-align: center; color: #FFF">Update food</h3>
            <form class="cat-form" action="" method="POST" enctype="multipart/form-data">
                <!--multipart Allow you to upload data-->
                <table class="cat-tbl">
                    <tr>
                        <td>Title </td>
                        <td>
                            <input type="text" name="food_title" value="<?php echo $food_title;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>
                            <input type="text" name="food_desc" value="<?php echo $food_desc?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            <input type="text" name="food_price" value="<?php echo $food_price?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td>
                            <img src="../images/food_image/<?php echo $current_image;?>" name="current_image">
                        </td>
                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td>
                            <input type="file" name="food_newImage">
                        </td>
                    </tr>
                    <tr>
                        <td>Food Category</td>
                        <td>
                            <select name="food_category" id="">
                                <?php
                                    $sql2 = "SELECT * FROM tbl_category WHERE cat_status = 'yes'";
                                    $stat2 = $cont->prepare($sql2);
                                    $stat2->execute();
                                    $count2 = $stat2->rowCount();
                                    if($count2 > 0) {
                                        while($row2 = $stat2->fetch()) {
                                            $cat_id = $row2['cat_id'];
                                            $cat_title = $row2['cat_title'];
                                            $_SESSION['cat_id'] = $cat_title;
                                            ?>
                                            <option <?php if($current_id == $cat_id){echo"selected";}?> value="<?php echo $cat_id;?>"><?php echo $cat_title;?></option>
                                            <?php
                                        }
                                    } else { ?>
                                        <option value="">Error</option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                        <input <?php if ($food_featured == "yes") {echo "checked";}?> type="radio" name="food_featured" value="yes"> Yes
                        <input  <?php if ($food_featured == "no") {echo "checked";}?> type="radio" name="food_featured" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Status </td>
                        <td>
                        <input <?php if ($food_status == "yes") {echo "checked";}?> type="radio" name="food_status" value="yes"> Yes
                        <input  <?php if ($food_status == "no") {echo "checked";}?> type="radio" name="food_status" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="c_image" value="<?php $current_image;?>">
                            <input type="hidden" name="id" value="<?php $food_id;?>">
                            <input type="submit" name="submit" value="Update Food">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php



if (isset($_POST['submit'])) {

   $food_id       = $_POST['id'];
   $food_title    = $_POST['food_title'];
   $food_desc     = $_POST['food_desc'];
   $food_price    = $_POST['food_price'];
   $c_image = $_POST['c_image'];
   $f_category    = $_POST['food_category'];

   $featured      =$_POST['food_featured'];
   $status        =$_POST['food_status'];

    if (isset($_FILES['food_newImage']['name'])) {
        $image_name = $_FILES['food_newImage']['name'];
        if ($image_name == '') {
                $image_name = $current_image;
        }else {
            $image_a = explode('.', $image_name);
            $image_exe = end($image_a);
            $image_name = 'food_'. rand(000, 999). "." . $image_exe;
            $image_path = $_FILES['food_newImage']['tmp_name'];
            $image_dest = '../images/food_image/' . $image_name;
            $upload     = move_uploaded_file($image_path, $image_dest);
            if ($upload == true) {
                //Remove The Image Is Image Is Exists 
                if (file_exists($current_image)) {

                $current_image_path ='../images/food_image/' . $current_image;
                $remove_img = unlink($current_image_path);
                if($remove_img == false) {
                    $_SESSION['remove_food'] = 'Failed To Remove';
                } else {
                    $_SESSION['remove_food'] = 'Successfully Removed';
                }
            
            }
            } else {
                echo "The Image Failed To Upload";
                $image_name = $current_image;
            }
        }
    }
    // Insert Data Into Food Table 

   $sql3 = "UPDATE `tbl_food` SET
      food_title = :f_title,
      food_desc = :f_desc,
      food_price = :f_price,
      food_imageName = :f_image, 
      cat_id = :f_cat, 
      food_featured = :f_featured, 
      food_status = :f_status 
      WHERE food_id = :f_id";
   $stat3 = $cont->prepare($sql3);
   $stat3->execute([
    'f_title' => $food_title, 
   'f_desc' =>$food_desc,
   'f_price' => $food_price,
   'f_image' => $image_name,
   'f_cat' =>$f_category, 
   'f_featured' =>$featured, 
   'f_status' =>$status, 
   'f_id' => $_id]);
   $count3 = $stat3->rowCount();
   if($count3 > 0) {
       echo "Welcome";
       $_SESSION['upload_food'] = 'The Data Uploaded Successfully';
       ?>
       <script>
       window.location.href = '<?php echo HOME_URL ?>CMS/manage_foods.php';
     </script>
     <?php
   } else {
    $_SESSION['upload_food'] = 'Failed To Upload';
    ?>
       <script>
       window.location.href = '<?php echo HOME_URL ?>CMS/manage_foods.php';
     </script>
    <?php
   }
}
?>