<?php
 include('includes/templates/header.php');

if (isset($_GET['order_id'])) {
    $Get_id = $_GET['order_id'];
    $sql_z = 'SELECT * FROM tbl_order WHERE order_id = :g_id';
    $stat_z = $cont->prepare($sql_z);
    $stat_z->execute([':g_id' => $Get_id]);
    $c_z = $stat_z->rowCount();
    if ($c_z <= 0) {
            echo "Welcomme";
            ?>
            <script>
            window.location.href = '<?php echo HOME_URL ?>CMS/manage_orders.php';
          </script>
          <?php
        }

} else {
    ?>
    <script>
    window.location.href = '<?php echo HOME_URL ?>CMS/manage_orders.php';
  </script>
  <?php  
}
$sql1 = "SELECT * FROM tbl_order WHERE order_id = :ord_id";
$stat1 = $cont->prepare($sql1);
$stat1->execute(['ord_id' => $Get_id]);
$count1 = $stat1->rowCount();
if($count1 > 0) {
    while($row = $stat1->fetch()) {
        $food_id        = $row['order_id'];
        $food_title    = $row['order_food'];
        $food_price    = $row['order_price'];
        $food_qte      = $row['order_qte'];
        $food_total    = $row['order_total'];
        $food_date     = $row['order_date'];
        $food_status   = $row['status'];
        $cust_name     = $row['customer_name'];
        $cust_contact  = $row['customer_contact'];
        $cust_email    = $row['customer_email'];
        $cust_address  = $row['customer_address'];


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
                        <td>Food Name</td>
                        <td>
                            <input type="text" name="ord_name" value="<?php echo $food_title;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            <input type="text" name="ord_price" value="<?php echo $food_price?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Guantity</td>
                        <td>
                            <input type="text" name="ord_qte" value="<?php echo $food_qte?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Total </td>
                        <td>
                        <input type="text" name="ord_total" value="<?php echo $food_total;?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Current Date</td>
                        <td>
                        <input type="text" name="u_orderdate" value="<?php echo $food_date;?>" disabled>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>New Date</td>
                        <td>
                            <input type="date" name="ord_newDate">
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                        <select name="ord_status">
                            <option <?php if ($food_status == 'ordered'){echo 'selected';}?> value="ordered">Ordered</option>
                            <option <?php if ($food_status == 'delevered'){echo 'selected';}?> value="delevered">Delevered</option>
                            <option <?php if ($food_status == 'canceled'){echo 'selected';}?> value="canceled">Canceled</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Custom Name</td>
                        <td>
                            <input type="text" name="cust_name" value="<?php echo $cust_name?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Custom Contact</td>
                        <td>
                            <input type="text" name="cust_contact" value="<?php echo $cust_contact?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Custom E-mail</td>
                        <td>
                            <input type="text" name="cust_email" value="<?php echo $cust_email?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Custom Address</td>
                        <td>
                            <input type="text" name="cust_address" value="<?php echo $cust_address?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="ord_id" value="<?php $ord_id;?>">
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

   $order_id        = $_POST['ord_id'];
   $order_title     = $_POST['ord_name'];
   $order_price     = $_POST['ord_price'];
   $order_qte       = $_POST['ord_qte']; 
   $order_status    = $_POST['ord_status'];
   $order_newDate   = $_POST['ord_newDate'];
   $ct_name         = $_POST['cust_name'];
   $ct_contact      = $_POST['cust_contact'];
   $ct_email        = $_POST['cust_email'];
   $ct_address      = $_POST['cust_address'];
         echo $food_date;
   if ($order_newDate == '') {
       $order_newDate = $food_date;
       echo $order_newDate;
   }
   $order_total = $order_price * $order_qte;
    // Insert Data Into Food Table 

   $sql3 =  "UPDATE tbl_order SET 
    order_food        = :ord_title,
    order_price       = :ord_price,
    order_qte         = :ord_qte, 
    order_total       = :ord_total,
    status            = :ord_status, 
    customer_name     = :cust_name,
    customer_contact  = :cust_contact,
    customer_email    = :cust_email,
    customer_address  = :cust_address,
    order_date        = :ord_date
    WHERE order_id = :ord_id
    ";
   $stat3 = $cont->prepare($sql3);
   $stat3->execute([
    'ord_title'     => $order_title, 
    'ord_price'     => $order_price,
    'ord_qte'       => $order_qte, 
    'ord_total'     => $order_total,
    'ord_date'      => $order_newDate,
    'ord_status'    => $order_status,
    'cust_name'     => $ct_name,
    'cust_contact'  => $ct_contact,
    'cust_email'    => $ct_email,
    'cust_address'  => $ct_address,
    'ord_id'        => $Get_id,
]);
   $count3 = $stat3->rowCount();
   if($count3 > 0) {
       echo "Welcome";
       $_SESSION['upload_food'] = 'The Data Uploaded Successfully';
       ?>
       <script>
       window.location.href = '<?php echo HOME_URL ?>CMS/manage_orders.php';
     </script>
     <?php
   } else {
    $_SESSION['upload_food'] = 'Failed To Upload';
    ?>
       <script>
       window.location.href = '<?php echo HOME_URL ?>CMS/manage_orders.php';
     </script>
    <?php
   }
}
?>