<?php
require_once("components/header.php");
require_once("dao/MovieDAO.php");

$movieDao = new MovieDAO($conn, $BASE_URL);
$latestMovies = $movieDao->getLatestMovies();
$actionsMovies = $movieDao->getMoviesbyCategory("Ação");
$comedyMovies = $movieDao->getMoviesbyCategory("Comédia");

function renderMovieSection($movies) {
    echo '<div class="movies-container">';
    foreach ($movies as $movie) {
        require("components/movie_card.php");
    }
    if (count($movies) === 0) {
        echo '<p class="empty-list">Ainda nao há filmes cadastrados</p>';
    }
    echo '</div>';
}

?>

<div class="main-container container-fluid">
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados no MovieStar</p>
    <?php renderMovieSection($latestMovies); ?>

    <h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação</p>
    <?php renderMovieSection($actionsMovies); ?>
    
    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de comédia</p>
    <?php renderMovieSection($comedyMovies); ?>

</div>

<?php require_once("components/footer.php") ?>