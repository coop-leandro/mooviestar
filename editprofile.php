<?php require_once("components/header.php");
    require_once('dao/UserDAO.php');
    $userDao = new UserDAO($conn, $BASE_URL);
    $userData = $userDao->verifyToken(true);
    
?> 

    <div class="main-container container-fluid">
        <h1>editar perfil</h1>
    </div>

<?php require_once("components/footer.php") ?> 
