<?php
require_once("components/header.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/MovieDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);
$movieDao = new MovieDAO($conn, $BASE_URL);
$id = filter_input(INPUT_POST, 'id');

if (empty($id)) {
    $userData = $userDao->verifyToken();
    if (!empty($userData->id)) {
        $id = $userData->id;
    } else {
        $message->setMessage('error', 'error', 'back');
        exit;
    }
} else {
    $userData = $userDao->findById($id);
    if (!$userData) {
        $message->setMessage('error', 'error', 'back');
        exit;
    }
}

$fullName = $userData->getFullName($userData);
$userMovies = $movieDao->getMoviesByUserId($id);

if ($userData->image == '') {
    $userData->image = 'user.png';
}
?>

<div class="main-container container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row profile-container">
            <div class="col-md-12 about-container">
                <h1 class="page-title"><?= $fullName ?></h1>
                <div id="profile-image-container" class="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
                <h3 class="about-title">Sobre:</h3>
                <?php if (!empty($userData->bio)): ?>
                    <p class="profile-description"><?= $userData->bio ?></p>
                <?php else: ?>
                    <p class="profile-description">O usuário ainda não escreveu nada aqui...</p>
                <?php endif; ?>
            </div>
            <div class="col-md-12 added-movies-container">
                <h3>Filmes que enviou:</h3>
                <div class="movies-container">
                    <?php foreach ($userMovies as $movie): ?>
                        <?php require("components/movie_card.php"); ?>
                    <?php endforeach; ?>
                    <?php if (count($userMovies) === 0): ?>
                        <p class="empty-list">O usuário ainda não enviou filmes.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("components/footer.php");
?>
