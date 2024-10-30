<?php
    require_once("models/Movie.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");
    require_once("dao/MovieDAO.php");
    require_once("globals.php");
    require_once("db.php");

    $message = new Message($BASE_URL);
    $userDao = new UserDAO($conn, $BASE_URL);
    $movieDao = new MovieDAO($conn, $BASE_URL);
    $userData = $userDao->verifyToken();
    $type = filter_input(INPUT_POST, "type");

    if($type === 'create'){
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        $trailer = filter_input(INPUT_POST, 'trailer');
        $category = filter_input(INPUT_POST, 'category');
        $length = filter_input(INPUT_POST, 'length');

        $movie = new Movie();

        function allNotEmpty(...$args){
            foreach($args as $arg){
                if(empty($arg)){
                    return false;
                }
            }
            return true;
        }

        if(allNotEmpty($title, $description, $category)){
            $movie->title = $title;
            $movie->description = $description;
            $movie->category = $category;
            $movie->trailer = $trailer;
            $movie->length = $length;
            $movie->users_id = $userData->id;

            if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
                $image = $_FILES['image'];
                $imageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                $jpgArr = ['image/jpeg', 'image/jpg'];
            
                if (in_array($image['type'], $imageTypes)) {
                    if (in_array($image['type'], $jpgArr)) {
                        $imageFile = imagecreatefromjpeg($image['tmp_name']);
                    } else {
                        $imageFile = imagecreatefrompng($image['tmp_name']);
                    }
            
                    if ($imageFile !== false) {
                        $imageName = $movie->imageGenerateName();
                        imagejpeg($imageFile, './img/movies/' . $imageName, 100);
                        $movie->image = $imageName;
                    } else {
                        $message->setMessage("image_error", "error", "back");
                    }
                } else {
                    $message->setMessage("image_invalid", "error", "back");
                }
            }
            $movieDao->create($movie);
        }else{
            $message->setMessage('required_fields', 'error', 'back');
        }

    }else{
        $message->setMessage('unauthorized', 'error', 'index.php');
    }