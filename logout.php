<?php 
    require_once("components/header.php");

    if($userDao){
        $userDao->destroyToken();
    }else{

    }