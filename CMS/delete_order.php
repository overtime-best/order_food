
<?php
include('includes/templates/header.php');
if (isset($_GET['order_id'])) {
    $get_id = $_GET['order_id'];
    $get_id;
}

$sql = 'DELETE FROM tbl_order WHERE order_id = :id';
$stat = $cont->prepare($sql);
$stat->execute(['id' =>$get_id]);
$count = $stat->rowCount();
if ($count > 0) {

    $_SESSION['delete_food'] = "The food Deleted Successfully";
    header("location: " . HOME_URL . "CMS/manage_orders.php");
   // header("refresh: 4; url=" . HOME_URL . 'CMS/manage_categories.php');


} else {
    echo "<h3 style='text-align: center; background: #F9EIE'> The Data Falied To Deleted </h3>";
    header("refresh: 4; url=" . HOME_URL . 'CMS/manage_orders.php');
 }