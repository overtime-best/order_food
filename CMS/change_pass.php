
<?php include('includes/templates/header.php');
    $admin = $_GET['id'];
?>
<div class="main-content">
    <?php
    if(isset($_POST['submit'])) {
    if (isset($_SESSION['change_pass'])) {  

            echo "<div style='text-align: center;'><h3 style='padding-top: 30px; color: #FFF;'>" . $_SESSION['change_pass'] . "</h3></div>";
    }

    } ?>
    <div class="container">
        <div class="box">
            <form class="add-user" action="" method="POST">
                <h3 style="text-align: center; margin-bottom: 20px">Change Password</h3>
                <label for="current_pass">Current Password</label>
                <input id="current_pass" type="password" name="current_pass">

                <label for="new_pass">New Password</label>
                <input id="new_pass" type="text" name="new_pass">

                <label for="confirm_pass">Confirm Password</label>
                <input id="confirm_pass" type="text" name="confirm_pass">
                <input type="hidden" name="id" value="<?php echo $admin ?>">
                <input class="submit" type="submit" name="submit" value="Change Password">
            </form>
        </div>
    </div>
</div>

<?php

    if (isset($_POST['submit'])) {

        $id = $_POST['id'];
        $current_pass = $_POST['current_pass'];
        $sha_pass = md5($current_pass);
        //$sub_pass = substr($current_pass, 0, 10);
        $new_pass = $_POST['new_pass'];
        $confirm_pass = $_POST['confirm_pass'];
        echo $current_pass . "<br>";
        $sql = 'SELECT * FROM tbl_admin WHERE admin_id = :id AND admin_password = :admin_pass';
        $stat = $cont->prepare($sql);
        $stat->execute(['id' => $id,'admin_pass' => $current_pass]);
        $count = $stat->rowCount();
        echo $count . "<br>";
        if ($count)
        if ($count > 0) {
            echo "Welcme Admin Number " . $id;
            if ($new_pass === $confirm_pass) {
                
                $sql2 = " UPDATE `tbl_admin` SET `admin_password` = :new_pass WHERE tbl_admin.`admin_id` = :admin_id";
                //$stat2 = $cont->query($sql2);
                $stat2 = $cont->prepare($sql2);
                $stat2->execute(['new_pass' => $new_pass, 'admin_id' => $admin]);
                $count = $stat2->rowCount();
                if ($count > 0) {

                    $_SESSION['change_pass'] = "The Password Changed Sucessfully";

                } else {
                    $_SESSION['change_pass'] = "The Opertation Failed !";
                }
            }
        }
    }

?>

<?php include('partials/footer.php'); ?>