<?php include('includes/templates/header.php');
//echo $cat_id;
if (isset($_GET['id'])) {
    $cat_id = $_GET['id'];
    $sql = 'SELECT * FROM tbl_category WHERE cat_id = ?';
    $stat = $cont->prepare($sql);   
    $stat->execute([$cat_id]);
    $count = $stat->rowCount();

    if ($count > 0) {
        while($row = $stat->fetch()) {
            $cat_id       = $row['cat_id'];
            $cat_title    = $row['cat_title'];
            $cat_image    = $row['cat_imageName'];
            $cat_featured = $row['cat_featured'];
            $cat_status   = $row['cat_status'];}
    } else {
        header("refresh: 1; url=" . HOME_URL . 'CMS/manage_categories.php');
    }

    
    if (isset($_POST['submit'])) {
        $cat_id        =$_POST['cat_id'];
        $cat_title     = $_POST['title'];
        $current_image = $_POST['current_image'];
        $cat_featured  = $_POST['cat_featured'];
        $cat_status    = $_POST['cat_status'];  

        if (isset($_FILES['cat_newImage']['name'])) {
                $image_name = $_FILES['cat_newImage']['name'];
                if ($image_name !== '') {
                    $image_a = explode('.', $image_name);
                    $image_exe = end($image_a);
                    $image_name = 'cat_'. rand(000, 999). "." . $image_exe;
                    $image_path = $_FILES['cat_newImage']['tmp_name'];
                    $image_dest = '../images/category_img/' . $image_name;
                    $upload     = move_uploaded_file($image_path, $image_dest);
                    if ($upload == true) {
                        //Remove The Image Is Image Is Exists 
                        if (file_exists($current_image)) {

                        $current_image_path ='../images/category_img/' . $current_image;
                        
                        $remove = unlink($current_image_path);}
                    } else {
                        echo "The Image Failed To Upload";
                        $image_name = '';
                    }
                }
            } else {
                $image_name = $cat_image;
            }
        $sql2 = 'UPDATE tbl_category SET 
        cat_title = :cat_title,
        cat_imageName = :cat_image,
        cat_featured = :cat_featured,
        cat_status = :cat_status
        WHERE cat_id = :cat_id';
    
     $stat2 = $cont->prepare($sql2);
     $stat2->execute(['cat_title' => $cat_title,
     'cat_image' =>$image_name,
     'cat_featured' => $cat_featured, 
     'cat_status' => $cat_status, 
     'cat_id' => $cat_id]);   
      $crow = $stat->rowCount();
      
      if ($crow > 0) {
        header("Location: " . HOME_URL . 'CMS/manage_categories.php');
        $_SESSION['edit_cat'] = 'The Category Uploaded Seccessfully';
      }
    
    }
?>

<div class="main-content">
    <div class="container">

    <div class="cat-box">
            <h3 style="margin: auto; text-align: center; color: #FFF">Edit Category</h3>
            <form class="cat-form" action="" method="POST" enctype="multipart/form-data"> <!--multipart Allow you to upload data-->
                <table class="cat-tbl">
                    <tr>
                        <td>Title </td>
                        <td>
                            <input type="text" name="title" placeholder="Title" value="<?php echo $cat_title;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image </td>
                        <td>
                            <?php 
                                if ($cat_image !== "") {
                                    //display the image 
                                    ?>
                                    <img src="<?php echo HOME_URL?>images/category_img/<?php echo $cat_image;?>" style='width: 325px'>
                                    <?php 
                                } else {
                                    echo "There's No Image";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td>
                            <input type="file" name="cat_newImage">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input <?php if ($cat_featured == "yes") {echo "checked";}?> type="radio" name="cat_featured" value="yes"> Yes
                            <input  <?php if ($cat_featured == "no") {echo "checked";}?> type="radio" name="cat_featured" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Status </td>
                        <td>
                            <input <?php if ($cat_status == "yes") {echo "checked";}?> type="radio" name="cat_status" value="yes">Yes
                            <input <?php if ($cat_status == "no") {echo "checked";}?> type="radio" name="cat_status" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="cat_id" value="<?php echo $cat_id;?>">
                            <input type="hidden" name="current_image" value="<?php echo $cat_image;?>">
                            <input type="submit" name="submit" value="Edit Category">
                        </td>
                    </tr>
                </table>
            <?php
             } else {
                header("refresh: 1; url=" . HOME_URL . 'CMS/manage_categories.php');
            }
            
            ?>
            </form>
        </div>
    </div>
</div>