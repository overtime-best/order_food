<?php
include('includes/templates/header.php');
$get_id = $_GET['id'];
$cat_image = $_GET['cat_image'];

if (isset($cat_image)) {
    if ($cat_image !== "") {
    // Path Of Image 
    $path = "../images/category_img/" . $cat_image;
    $removeImage = unlink($path);
    if ($removeImage == false) {header("refresh: 2; url=" . HOME_URL . 'CMS/manage_categories.php');}
    
    } 
}
$sql = 'DELETE FROM tbl_category WHERE cat_id = :get_id';
$stat = $cont->prepare($sql);
$stat->execute(['get_id' =>$get_id]);
$count = $stat->rowCount();
if ($count > 0) {

    $_SESSION['delete_cat'] = "The Category Deleted Successfully";
    header("location: " . HOME_URL . "CMS/manage_categories.php");
   // header("refresh: 4; url=" . HOME_URL . 'CMS/manage_categories.php');


} else {
    echo "<h3 style='text-align: center; background: #F9EIE'> The Data Falied To Deleted </h3>";
    header("refresh: 4; url=" . HOME_URL . 'CMS/manage_categories.php');
 }