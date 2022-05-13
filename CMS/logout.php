<?php 
// destroy The Session
session_destroy();
include('init.php');
session_destroy();
header('location:' . HOME_URL . 'CMS/login.php');
session_unset();