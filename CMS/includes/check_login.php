<?php

if (!isset($_SESSION['user'])) {

    $_SESSION['message'] = 'Please Inter The Correct Info';
   header('Location:' . HOME_URL . "CMS/login.php");
}