<?php
require_once("components/header.php");
require_once("dao/MovieDAO.php");

$movieDao = new MovieDAO($conn, $BASE_URL);
$q = filter_input(INPUT_GET, 'q');
$movies = $movieDao->findByTitle($q);

function renderMovieSection($movies) {
    echo '<div class="movies-container">';
    foreach ($movies as $movie) {
        require("components/movie_card.php");
    }
    if (count($movies) === 0) {
        echo '<p class="empty-list">Filme nao encontrado <a class="back-link" href="<?=$BASE_URL?>">Voltar</a></p>';
    }
    echo '</div>';
}

?>

<div class="main-container container-fluid">
    <h2 class="section-title" id="search-title">Voce esta buscando por <span id="search-result"><?= $q ?></span></h2>
    <p class="section-description">Resultados de acordo com sua pesquisa:</p>
    <?php renderMovieSection($movies); ?>

</div>

<?php require_once("components/footer.php") ?>