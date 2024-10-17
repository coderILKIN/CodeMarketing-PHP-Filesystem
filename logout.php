<?php


setcookie('email', '', time() - 3600, '/');
setcookie('username', '', time() - 3600, '/');


unset($_COOKIE['email']);
unset($_COOKIE['username']);

header('location:login.php');