<?php
    session_start();

    //  logout for your application
    //  close connection object
    //  close/clear statement object
    //  clear/destroy session variables
    //  return the user to the home page/login page
    //  PHP redirect

    //  clear/destroy your session variables
    session_unset();
    session_destroy();

    $conn = null;
    $stmt = null;

    //  send user to the login page
    header("Location: login.php");

?>