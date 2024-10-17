<?php


function checkUseIsLogin(){

    if(isset($_COOKIE['email'], $_COOKIE['username'])){
        header('Location: login.php');
    }
    
}
