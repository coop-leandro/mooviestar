<?php
require_once("components/header.php");
require_once("dao/MovieDAO.php");

$movieDao = new MovieDAO($conn, $BASE_URL);
$latestMovies = $movieDao->getLatestMovies();
$actionsMovies = $movieDao->getMoviesbyCategory("Ação");
$comedyMovies = $movieDao->getMoviesbyCategory("Comédia");
?>

<div class="main-container container-fluid">
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados no MovieStar</p>
    <div class="movies-container">
        <?php foreach ($latestMovies as $movie) : ?>
            <?php require("components/movie_card.php"); ?>
        <?php endforeach ?>
        <?php if (count($latestMovies) === 0) : ?>
            <p class="empty-list">Ainda nao há filmes cadastrados</p>
        <?php endif ?>
    </div>
    <h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação</p>
    <div class="movies-container">
        <?php if (count($actionsMovies) === 0) : ?>
            <p class="empty-list">Ainda nao há filmes cadastrados</p>
        <?php endif ?>
    </div>
    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de comédia</p>
    <div class="movies-container">
        <?php if (count($comedyMovies) === 0) : ?>
            <p class="empty-list">ainda nao há filmes cadastrados</p>
        <?php endif ?>
    </div>
</div>

<?php require_once("components/footer.php") ?>