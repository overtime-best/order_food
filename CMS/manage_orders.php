<?php include('includes/templates/header.php'); ?>
    <!-- Navbar Section Ends Here -->

    <!-- Start Main-Content -->
    <div class="main-content">
        <div class="container">
        <div class="wrapper">
            <h1>Mange Order</h1>
            <table class="admin">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quintity</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Custom Name</th>
                        <th>Custom Contact</th>
                        <th>Custom E-mail</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       $sql = 'SELECT * FROM tbl_order ORDER BY order_id DESC';
                       $stat = $cont->prepare($sql);
                       $stat->execute();
                       $c = $stat->rowCount();
                       $id = 1;
                       if ($c > 0) {
                           while($row = $stat->fetch()) {
                              $ord_id       = $row['order_id'];
                              $ord_food     = $row['order_food'];
                              $ord_price    = $row['order_price'];
                              $ord_qte      = $row['order_qte'];
                              $ord_total    = $row['order_total'];
                              $ord_date     = $row['order_date'];
                              $ord_status   = $row['status'];
                              $cust_name    = $row['customer_name'];
                              $cust_contact = $row['customer_contact'];
                              $cust_email = $row['customer_email'];
                              ?>
                                <tr>
                                    <td><?php echo $id++;?></td>
                                    <td><?php echo $ord_food;?></td>
                                    <td><?php echo $ord_price;?></td>
                                    <td><?php echo $ord_qte;?></td>
                                    <td><?php echo $ord_total;?></td>
                                    <td><?php echo $ord_date;?></td>
                                    <td><?php echo $ord_status;?></td>
                                    <td><?php echo $cust_name;?></td>
                                    <td><?php echo $cust_contact;?></td>
                                    <td><?php echo $cust_email;?></td>
                                    <td class="edit"><a href="edit_order.php?order_id=<?php echo $ord_id;?>"> Edit</a></td>
                                    <td class="delete"><a href="delete_order.php?order_id=<?php echo $ord_id;?>">Delete</a></td>
                                </tr>
                            <?php
                           }
                       }

                    ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>

     <!-- End Main-Content -->



       <!-- social Section Starts Here -->
       <?php include('includes/templates/footer.php'); ?>