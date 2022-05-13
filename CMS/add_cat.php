
<?php include('includes/templates/header.php');
if (isset($_POST['submit'])) {

    $cat_title = $_POST['title'];
    $cat_featured = $_POST['cat_featured'];
    $cat_status = $_POST['cat_status'];

    if (isset($_FILES['image'])) {

        $image_name = $_FILES['image'] ['name'];
        $img_array = explode('.', $image_name); // first we Seperete this To Two Arrays 
        //print_r($img_array);
        $img_extentation = end($img_array); // This To Get The Last Value in Array 
        //echo $img_extentation. "</br>";
        $image_name = "cat_". rand(0000, 999) .".". $img_extentation ;
       // echo $image_name;

        $image_source = $_FILES['image'] ['tmp_name'];
        $image_dest = "../images/category_img/" . $image_name;

        $upload = move_uploaded_file($image_source, $image_dest);
        if ($upload == false) {

            $image_name = "";
        }
       // echo 'The Image Name Is : ' . $image_name .'The Image Source Is : '  . $image_source;
    }
    // print_r($_FILES['image']);
    $sql = "INSERT INTO tbl_category

    (cat_title,cat_imageName, cat_featured , cat_status)

    VALUES(:cat_title, :cat_image,  :cat_featured,:cat_status )";

    //$stat = $cont->query('SELECT * FROM tbl_admin');
    $stat = $cont->prepare($sql);
    $stat->execute(['cat_title' => $cat_title,'cat_image' =>$image_name, ':cat_featured' => $cat_featured, ':cat_status' => $cat_status]);
    $count = $stat->rowCount();
    if ($count > 0) {
        echo "The Data Inserted Successfully";
         $_SESSION['add_cat'] = "The Category Added Successfully";
        // //sleep(2);
        // header('Location:' . HOME_URL . 'CMS/manage_admin.php');
        header("Location: " . HOME_URL . 'CMS/manage_categories.php');
        exit;
    } else {
        echo "Failed";
    }
}
?>

<div class="main-content">
    <div class="container">
        <div class="cat-box">
            <h3 style="margin: auto; text-align: center; color: #FFF">Add Category</h3>
            <form class="cat-form" action="" method="POST" enctype="multipart/form-data"> <!--multipart Allow you to upload data-->
                <table class="cat-tbl">
                    <tr>
                        <td>Title </td>
                        <td>
                            <input type="text" name="title" placeholder="Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input type="radio" name="cat_featured" value="yes" required> Yes
                            <input type="radio" name="cat_featured" value="no" requireed> No
                        </td>
                    </tr>
                    <tr>
                        <td>Status </td>
                        <td>
                            <input type="radio" name="cat_status" value="yes" required> Yes
                            <input type="radio" name="cat_status" value="no" required> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>