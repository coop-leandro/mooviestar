<?php 
    require_once('components/header.php');
    require_once('models/Movie.php');
    require_once('dao/MovieDAO.php');


    $movieDao = new MovieDAO($conn, $BASE_URL);

    $id = filter_input(INPUT_GET, 'id');
    $movie;
    if(empty($id)){
        $message->setMessage('error', 'error', 'index.php');
    } else {
        $movie = $movieDao->findById($id);
        if(!$movie){
            $message->setMessage('error', 'error', 'index.php');
        }
    }

    $UserOwnsMovie = false;

    if(!empty($userData)){
        if($userData->id === $movie->users_id){
            $UserOwnsMovie = true;
        }
    }

?>

