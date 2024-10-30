<?php
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");
    require_once("globals.php");
    require_once("db.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $message = new Message($BASE_URL);
    $type = filter_input(INPUT_POST, "type");

    if($type === "register"){
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        if($name && $lastname && $email && $password){
            if($password === $confirmpassword){
                 if($userDao->findByEmail($email) === false){
                    $user = new User();

                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);

                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;
                    $auth = true;
                    $userDao->create($user, $auth);
                }else{
                    $message->setMessage("email", "error", "back");
                 }
            }else{
                $message->setMessage("error", "error", "back");
            }
        }else{
            $message->setMessage("required_fields", "error", "back");
        }

    }else if($type === "login"){
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        if(empty($email) || empty($password)){
            $message->setMessage('required_fields', 'error', 'back');
        }else{
            if($userDao->authenticateUser($email, $password)){
                $message->setMessage("login", "success", "editprofile.php");
            }else{
                $message->setMessage("incorrect_fields", "error", "back");
            }
        }
    }else{
        $message->setMessage("unauthorized", "error", "index.php");
    }