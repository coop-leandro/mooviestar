<?php 
    require_once("models/Movie.php");
    require_once("models/Message.php");

    class MovieDAO implements MovieDAOInterface{
        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url){
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildMovie($data){
            $movie = new Movie();

            $movie->id = $data['id'];
            $movie->title = $data['title'];
            $movie->description = $data['description'];
            $movie->image = $data['image'];
            $movie->trailer = $data['trailer'];
            $movie->category = $data['category'];
            $movie->length = $data['length'];
            $movie->users_id = $data['users_id'];
            return $movie;
        }

        public function findAll(){

        }

        public function getLatestMovies(){
            $movies = [];
            $stmt = $this->conn->query('SELECT * FROM moovies ORDER BY id DESC');
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $moviesArr = $stmt->fetchAll();
                foreach($moviesArr as $movie){
                    $movies[] = $this->buildMovie($movie);
                }
            }
            return $movies;
        }

        public function getMoviesbyCategory($category){
            $movies = [];
            $stmt = $this->conn->prepare('SELECT * FROM moovies 
                WHERE category = :category
                ORDER BY id DESC');
            $stmt->bindParam(':category', $category);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $moviesArr = $stmt->fetchAll();
                foreach($moviesArr as $movie){
                    $movies[] = $this->buildMovie($movie);
                }
            }
            return $movies;
        }

        public function getMoviesByUserId($id){
            $movies = [];
            $stmt = $this->conn->prepare('SELECT * FROM moovies 
                WHERE id = :id
                ORDER BY id DESC');
            $stmt->bindParam(':id', $users_id);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $moviesArr = $stmt->fetchAll();
                foreach($moviesArr as $movie){
                    $movies[] = $this->buildMovie($movie);
                }
            }
            return $movies;
        }

        public function findById($id){
            
        }

        public function findByTitle($title){
            
        }

        public function create(Movie $movie){
            $stmt = $this->conn->prepare('INSERT INTO moovies( 
            title, description, image, trailer, category, length, users_id
            ) VALUES (:title, :description, :image, :trailer, :category, :length, :users_id)');
            $stmt->bindParam(':title', $movie->title);
            $stmt->bindParam(':description', $movie->description);
            $stmt->bindParam(':image', $movie->image);
            $stmt->bindParam(':trailer', $movie->trailer);
            $stmt->bindParam(':category', $movie->category);
            $stmt->bindParam(':length', $movie->length);
            $stmt->bindParam(':users_id', $movie->users_id);
            $stmt->execute();
            $this->message->setMessage('movie_add', 'success', 'index.php');
        }

        public function update(Movie $movie){
            
        }

        public function destroy($id){
            
        }
    }