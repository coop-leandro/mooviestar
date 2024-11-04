<?php
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("models/Review.php");
    require_once("dao/UserDAO.php");
    require_once("dao/MovieDAO.php");
    require_once("dao/ReviewDAO.php");
    require_once("globals.php");
    require_once("db.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);
    $movieDao = new MovieDAO($conn, $BASE_URL);
    $reviewDao = new ReviewDAO($conn, $url);
    $userData = $userDao->verifyToken();

    $type = filter_input(INPUT_POST, "type");

    function allNotEmpty(...$args){
        foreach($args as $arg){
            if(empty($arg)){
                return false;
            }
        }
        return true;
    }

    if($type === 'create'){
        $rating = filter_input(INPUT_POST, 'rating');
        $review = filter_input(INPUT_POST, 'review');
        $movies_id = filter_input(INPUT_POST, 'movies_id');

        $reviewObject = new Review();

        $movieData = $movieDao->findById($movies_id);
        if($movieData){
            if(allNotEmpty($rating, $review, $movies_id)){
                $reviewObject->rating = $rating;
                $reviewObject->review = $review;
                $reviewObject->movies_id = $movies_id;
                $reviewObject->users_id = $userData->id;

                $reviewDao->create($reviewObject);
            }else{
                $message->setMessage('required_fields', 'error', 'back');
            }
        }else{
            $message->setMessage('error', 'error', 'index.php');
        }
    }else{
        $message->setMessage('error', 'error', 'index.php');
    }