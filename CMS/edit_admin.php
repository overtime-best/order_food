
<?php include('includes/templates/header.php');
   $admin = $_GET['id'];
   $sql = "SELECT * FROM tbl_admin WHERE admin_id = ?";

   $stat = $cont->prepare($sql);
   $stat->execute([$admin]);
   while($row = $stat->fetch()) {

        $admin_id =   $row['admin_id'];
        $admin_name =  $row['admin_name'];
        $admin_username = $row['admin_username'];
        $admin_email = $row['admin_email'];    
   }
?>


<div class="main-content">
    <div class="container">
    <?php
                if (isset($_POST['submit'])) {
                if (isset($_SESSION['edit'])) {
                    $edit = $_SESSION['edit']
                    ?>
                        <div><h3 style="color:#FFF; text-align:center; margin-bottom: 0"><?php echo $edit;?></h3></div>
                    <?php 
                }
            }
            ?>
        <div class="box">
            <form class="add-user" action="" method="POST">
                <h3 style="text-align: center; margin-bottom: 20px">Edit Admin</h3>
                <label for="fullname">Fullname</label>
                <input id="fullname" type="text" name="fullname" value="<?php echo $admin_name ?>">

                <label for="username">Username</label>
                <input id="username" type="text" name="username" value="<?php echo $admin_username ?>">

                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" value="<?php echo $admin_email?>">
                <input type="hidden" name="id" value="<?php echo $admin ?>">
                <input class="submit" type="submit" name="submit" value="sign-up">
            </form>
        </div>
    </div>
</div>

<?php

    if (isset($_POST['submit'])) {

        $admin_name = $_POST['fullname'];
        $admin_user = $_POST['username'];
        $admin_mail = $_POST['email'];
        //echo $admin_name . "<>" .$admin_user . "<>" . $admin_email;
        $sql = "UPDATE tbl_admin SET admin_name = :sname, admin_username = :username , admin_email= :email WHERE admin_id = :id";
        $stat = $cont->prepare($sql);
        $stat->execute(['sname'=>$admin_name, 'username'=>$admin_user, 'email'=>$admin_mail, 'id'=>$admin]);
        $count = $stat->rowCount();
        if ($count > 0) {
            
           $_SESSION['edit_admin'] = "The Data Uploaded Successfully";

            header("Location: " . HOME_URL . 'CMS/manage_admin.php');
        } 
        else {
            $_SESSION['edit_admin'] = "The Data Uploaded Falied ! ";

            header("Location: " . HOME_URL . 'CMS/manage_admin.php');
        }
    }

?>