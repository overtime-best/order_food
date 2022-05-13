<?php
include('config/_config.php');
// Get The Admin Id 
$id = $_GET['id'];
$sql = "DELETE FROM tbl_admin WHERE admin_id = ?";

$stat = $cont->prepare($sql);
$stat->execute([$id]);
$count = $stat->rowCount();

if ($count > 0) {

    $_SESSION['delete_admin'] = "The Admin Deleted Successfully";
    header("Location: " . HOME_URL . 'CMS/manage_admin.php');
} else {
    $_SESSION['delete_admin'] = "The Admin fail Deleted";
}


