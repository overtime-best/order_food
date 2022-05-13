<style>
    .box .add-user input{
        display: block;
        width: 300px;
        padding: 7px;
    }
    .main-content{
        display: flex;
        justify-content: center;
    }
    .box {
            margin-top: 200px;
    }
    body{
        background-color:tomato;
    }
</style>
<?php include('init.php'); ?>

<?php 


?>
<div class="main-content">
    <div class="container">
    <?php
        if (isset($_POST['submit'])) {
            if (isset($_SESSION['message'])) {
         echo "<h3 style='text-align: center; color: #FFF'> " . $_SESSION['message'] . "</h3>";} }?>
        <div class="box">
            <form class="add-user" action="" method="POST">
                <h3 style="text-align: center; margin-bottom: 20px">Login Admin</h3>
                <label for="username">Username</label>
                <input id="username" type="text" name="username" placeholder="Username">

                <label for="admin_pass">Password</label>
                <input id="admin_pass" type="password" name="admin_pass" placeholder="password">
                <input class="submit" type="submit" name="submit" value="Login">
            </form>
        </div>
    </div>
</div>

<?php

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['admin_pass'];
        $sql = 'SELECT admin_username, admin_password FROM tbl_admin WHERE admin_username = :username AND admin_password = :pass';
        $stat = $cont->prepare($sql);
        $stat->execute(['username' => $username, 'pass' =>$password]);
        $count = $stat->rowCount();
        echo $count . "<br>";
        if ($count > 0) {
            $_SESSION['user'] = $username; //To Check Wether The User Is Logged In Or Not 
            $_SESSION['admin_login'] = "Welcome To Admin Page";
            header('location:' . HOME_URL . "CMS/index.php");
        } else {
            $_SESSION['admin_login'] = "Please Try Again";
        }
    }

?>