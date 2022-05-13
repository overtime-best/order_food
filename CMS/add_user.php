<?php include('includes/templates/header.php');
   if (isset($_POST['submit'])) {
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $password = ($_POST['password']);
            $sha_pass = md5($password);
            //$sub_pass = substr($password, 0, 10);
            $email    = $_POST['email'];
            
            $sql = "INSERT INTO tbl_admin(admin_name, admin_username, admin_password, admin_email)VALUES(:sname, :username, :pass, :email)";
            //$stat = $cont->query('SELECT * FROM tbl_admin');
           $stat = $cont->prepare($sql);
           $stat->execute(['sname' => $fullname, ':username' =>$username, ':pass' =>$password, 'email' => $email]);
           $count = $stat->rowCount();
           if ($count > 0) {
             
            $_SESSION['add_admin'] = "The Admin Added Successfully";
            //sleep(2);
            header('Location:'. HOME_URL .'CMS/manage_admin.php');
            //header("refresh: 2; url=" . HOME_URL . 'CMS/manage_admin.php');
            exit;
           } else {
            $_SESSION['add'] = "Failed To Added Admin ";
           }
        }
?>
<div>
    <?php if (isset($_SESSION['welcome'])) {
        echo $_SESSION['welcome'];
    } ?>
</div>

<div class="main-content">
    <div class="container">
        <div class="box">
            <form class="add-user" action="" method="POST">
                <h3 style="text-align: center; margin-bottom: 20px">User Information</h3>
                <label for="fullname">Fullname</label>
                <input id="fullname" type="text" name="fullname">

                <label for="username">Username</label>
                <input id="username" type="text" name="username">

                <label for="password">Password</label>
                <input id="password" type="password" name="password">

                <label for="email">E-mail</label>
                <input id="email" type="email" name="email">

                <input class="submit" type="submit" name="submit" value="sign-up">
            </form>
        </div>
    </div>
</div>