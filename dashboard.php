<?php
  require_once("components/header.php");
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  $user = new User();
  $userDao = new UserDAO($conn, $BASE_URL);
  $movieDao = new MovieDAO($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);
  $userMovies = $movieDao->getMoviesByUserId($userData->id);

?>

    <div class="main-container container-fluid">
        <h2 class="section-title">Dashboard</h2>
        <p class="section-description">Adicione ou atualize as informações dos filmes que voce enviou</p>
        <div class="col-md-12" id="add-movie-container">
            <a href="<?= $BASE_URL ?>newmoovie.php" class="btn card-btn">
                <i class="fas fa-plus"></i>Adicionar filme
            </a>
        </div>
        <div class="col-md-12" id="movies-dashboard">
            <table class="table">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Nota</th>
                    <th scope="col">Ações</th>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td><a href="" class="table-movie-title"></a></td>
                        <td>
                            <i class="fas fa-star"></i>9
                        </td>
                        <td class="actions-column">
                            <a href="" class="edit-btn"><i class="far fa-edit"></i>Editar</a>
                            <form action="">
                                <button type="submit" class="delete-btn">
                                    <i class="fas fa-times"></i>Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php   require_once("components/footer.php"); ?>