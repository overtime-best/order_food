<?php include('includes/templates/header.php'); ?>
    <!-- Navbar Section Ends Here -->

    <!-- Start Main-Content -->
    <div class="main-content">
        <div class="container">
            <h1 class="main-header">Admin Page</h1>
            <?php
                if  (isset($_SESSION['edit_admin'])) {

                    echo '<h4 class="session-msg">' . $_SESSION['edit_admin'] . '</h4>';
                    unset ($_SESSION['edit_admin']);
                }

                if  (isset($_SESSION['add_admin'])) {

                    echo '<h4 class="session-msg">' . $_SESSION['add_admin'] . '</h4>';
                    unset ($_SESSION['add_admin']);
                }

                if  (isset($_SESSION['delete_admin'])) {

                    echo '<h4 class="session-msg">' . $_SESSION['delete_admin'] . '</h4>';
                    unset ($_SESSION['delete_admin']);
                }

                    ?>
                    <?php
            ?>
            <button class="button">
                <h3><a href="add_user.php">Add Admin</a></h3>  
            </button>
            <div class="wrapper">
            <table class="admin">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Change Password</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    $sql = "SELECT * FROM tbl_admin";
                    $stat = $cont->prepare($sql);
                    $stat->execute();
                    $id = 1;
                    while($row = $stat->fetch()) {
                        $admin_id = $row['admin_id'];
                    ?>
                            <tr>
                                <td><?php echo $id++ ?></td>
                                <td><?php echo $row['admin_name'];?></td>
                                <td><?php echo $row['admin_username'];?></td>
                                <td><?php echo $row['admin_email'];?></td>
                                <td class="change_password">
                                    <a href="change_pass.php?id=<?php echo $admin_id?>">Chage Password</a></td>
                                <td class="edit"><a href="edit_admin.php?id=<?php echo $admin_id?>"> Edit </a></td>
                                <td class="delete"><a href="delete_admin.php?id=<?php echo $admin_id?>">Delete</a></td>
                            </tr>
                    <?php 
                    }
                
                ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>