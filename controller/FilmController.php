<?php
require_once 'app/DAO.php';


class FilmController
{
        // function qui permet de récupérer la liste de tout les films ajoutés en BDD
        public function listFilms()
        {
                $dao = new DAO();

                $sql = 'SELECT id_movie, title, date_format(release_date, "%Y") year, duration, synopsys, notation, poster 
                FROM movie
                ORDER BY release_date DESC';

                $films = $dao->executeRequest($sql);
                require 'view/film/listFilms.php';
        }

        public function viewMovie($id_movie)
        {
                $dao = new DAO();

                $sql = 'SELECT id_movie, title, date_format(release_date, "%Y") year, duration, synopsys, notation, poster 
                FROM movie
                WHERE id_movie = :id';

                $sql2 = 'SELECT actor_id, lastname, firstname, r.name 
                FROM actor a
                INNER JOIN person p
                ON p.id_person=a.person_id
                INNER JOIN casting c
                ON c.actor_id=a.id_actor
                INNER JOIN movie m
                ON c.movie_id=m.id_movie
                INNER JOIN role r 
                ON r.id_role=c.role_id
                WHERE id_movie = :id
                GROUP BY actor_id, lastname, firstname, r.name';

                $sql3 = 'SELECT firstname, lastname, director_id FROM director d
                        INNER JOIN person p
                        ON p.id_person=d.id_director
                        INNER JOIN movie m
                        ON m.director_id=d.id_director
                        WHERE id_movie = :id
                        GROUP BY firstname, lastname, director_id
                ';

                $param = [
                        'id' => $id_movie,
                ];

                $film = $dao->executeRequest($sql, $param);
                $castings = $dao->executeRequest($sql2, $param);
                $directors = $dao->executeRequest($sql3, $param);
                require 'view/film/viewMovie.php';
        }

        public function addGenre()
        {
                if (isset($_POST["addGenre"])) {

                        // Récupérer les données du formulaire
                        $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                        $dao = new DAO();

                        $sql = "INSERT INTO genre (label)
                                VALUES (:label)";

                        $param = [
                                'label' => $label,
                        ];

                        $addGenre = $dao->executeRequest($sql, $param);
                }

                require 'view/film/addGenreForm.php';
        }

        public function addGenreForm()
        {
                require 'view/film/addGenreForm.php';
        }

        public function addMovie()
        {
                // Vérifier si le formulaire est soumis
                if (isset($_POST["addMovie"])) {
                        // Récupérer les données du formulaire
                        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $releaseDate = filter_input(INPUT_POST, "releaseDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $duration = filter_input(INPUT_POST, "duration", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $synopsys = filter_input(INPUT_POST, "synopsys", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $notation = filter_input(INPUT_POST, "notation", FILTER_SANITIZE_SPECIAL_CHARS);
                        $poster = filter_input(INPUT_POST, "poster", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $director = filter_input(INPUT_POST, "director", FILTER_SANITIZE_SPECIAL_CHARS);

                        $dao = new DAO();

                        $sql = "INSERT INTO movie (title, release_date, duration, synopsys, notation, poster, director_id)
                VALUES (:title, :release_date, :duration, :synopsys, :notation, :poster, :director_id)";

                        $param = [
                                'title' => $title,
                                'release_date' => $releaseDate,
                                'duration' => $duration,
                                'synopsys' => $synopsys,
                                'notation' => $notation,
                                'poster' => $poster,
                                'director_id' => $director,
                        ];

                        $dao->executeRequest($sql, $param);

                        // Récupérer l'ID du dernier film ajouté
                        $movie_id = $dao->getLastInsertId();

                        // Insérer dans la table belongs
                        $sql_belongs = "INSERT INTO belongs (movie_id, genre_id) VALUES (:movie_id, :genre_id )";

                        $param_belongs = [
                                'movie_id' => $movie_id,
                                'genre_id' => $genre,
                        ];


                        $dao->executeRequest($sql_belongs, $param_belongs);


                        require 'view/film/addMovieForm.php';
                }
        }
        public function addMovieForm()
        {
                $dao = new DAO();

                $sql2 = "SELECT firstname, lastname, id_director FROM person p
                                INNER JOIN director d
                                ON d.person_id = p.id_person";

                $sql3 = "SELECT id_genre, label FROM genre";

                $genrelist = $dao->executeRequest($sql3);
                $directorlist = $dao->executeRequest($sql2);

                require 'view/film/addMovieForm.php';
        }
        public function deleteMovie($id)
        {

                $dao = new DAO();

                // Define the SQL query
                $sql = "DELETE FROM movie WHERE id_movie = :id";

                // Define the parameter array
                $param = [
                        'id' => $id,
                ];

                // Execute the query
                $dao->executeRequest($sql, $param);
                header("Location: index.php?action=listFilms");
                exit();
        }
        public function modifyMovie($id)
        {
                if (isset($_POST["modifyMovie"])) {

                        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $releaseDate = filter_input(INPUT_POST, "releaseDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $duration = filter_input(INPUT_POST, "duration", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $synopsys = filter_input(INPUT_POST, "synopsys", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $notation = filter_input(INPUT_POST, "notation", FILTER_SANITIZE_SPECIAL_CHARS);
                        $poster = filter_input(INPUT_POST, "poster", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $director = filter_input(INPUT_POST, "director", FILTER_SANITIZE_SPECIAL_CHARS);

                        $dao = new DAO();

                        // Construct the base SQL query
                        $sql = "UPDATE movie m
                                SET ";

                        $param = [];

                        // Build the SET clause and parameter array for each non-empty field
                        if (!empty($title)) {
                                $sql .= "title = :title, ";
                                $param['title'] = $title;
                        }

                        if (!empty($releaseDate)) {
                                $sql .= "releaseDate = :releaseDate, ";
                                $param['releaseDate'] = $releaseDate;
                        }

                        if (!empty($duration)) {
                                $sql .= "duration = :duration, ";
                                $param['duration'] = $duration;
                        }

                        if (!empty($synopsys)) {
                                $sql .= "synopsys = :synopsys, ";
                                $param['synopsys'] = $synopsys;
                        }
                        if (!empty($notation)) {
                                $sql .= "notation = :notation, ";
                                $param['notation'] = $notation;
                        }

                        if (!empty($poster)) {
                                $sql .= "poster = :poster, ";
                                $param['poster'] = $poster;
                        }
                        if (!empty($genre)) {
                                $sql .= "genre = :genre, ";
                                $param['genre'] = $genre;
                        }
                        if (!empty($director)) {
                                $sql .= "director = :director, ";
                                $param['director'] = $director;
                        }

                        // Remove the trailing comma and space from the SQL query
                        $sql = rtrim($sql, ", ");

                        // Add the WHERE clause
                        $sql .= " WHERE id_movie = :id";

                        // Add the id parameter
                        $param['id'] = $id;

                        // Execute the query
                        $dao->executeRequest($sql, $param);
                }

                require 'view/film/modifyMovieForm.php';
        }

        public function modifyMovieForm($id)
        {
                
                require 'view/film/modifyMovieForm.php';
        }

        public function addCasting()
        {
                $isNewEmptyForm = true;

                // Vérifier si le formulaire est soumis
                if (isset($_POST["addCasting"])) {
                        // Récupérer les données du formulaire
                        $movie_id = filter_input(INPUT_POST, "movie", FILTER_SANITIZE_NUMBER_INT);
                        $actor_id = filter_input(INPUT_POST, "actor", FILTER_SANITIZE_NUMBER_INT);
                        $role_id = filter_input(INPUT_POST, "role", FILTER_SANITIZE_NUMBER_INT);

                        $dao = new DAO();

                        $sqlInsertCasting = "INSERT INTO casting (movie_id, actor_id, role_id)
                                VALUES (:movie_id, :actor_id, :role_id)";

                        // $sql1 = "SELECT id_movie, title FROM movie";

                        // $sql2 = "SELECT firstname, lastname, id_actor FROM person p
                        //         INNER JOIN actor a
                        //         ON a.person_id = p.id_person";

                        // $sql3 = "SELECT id_role, name FROM role";

                        $insertCastingParams = [
                                'movie_id' => $movie_id,
                                'actor_id' => $actor_id,
                                'role_id' => $role_id,
                        ];

                        try {
                                $isInsertCastingSuccess = $dao->executeRequest($sqlInsertCasting, $insertCastingParams);
                        } catch (\Throwable $th) {
                                $isInsertCastingSuccess = false;
                        }

                        // $dropDownMovies = $dao->executeRequest($sql1);
                        // $dropDownActors = $dao->executeRequest($sql2);
                        // $dropDownRoles = $dao->executeRequest($sql3);

                        if (!$isInsertCastingSuccess) {
                                $isNewEmptyForm = false;
                        }
                }

                if ($isNewEmptyForm) {
                        $this->addCastingForm(); // contient SQL + require Vue
                } else {
                        $formValues = [
                                'movieId' => $movie_id,
                                'actorId' => $actor_id,
                                'roleId' => $role_id,
                        ];

                        $this->addCastingForm($formValues); // en argument les valeurs saisies
                }
        }

        public function addCastingForm($formValues = null)
        {
                $dao = new DAO();

                $sqlMovies = "SELECT id_movie, title FROM movie";

                $sqlActors = "SELECT firstname, lastname, id_actor FROM person p
                INNER JOIN actor a
                ON a.person_id = p.id_person";

                $sqlRoles = "SELECT id_role, name FROM role";



                $dropDownMovies = $dao->executeRequest($sqlMovies);
                $dropDownActors = $dao->executeRequest($sqlActors);
                $dropDownRoles = $dao->executeRequest($sqlRoles);

                require 'view/film/addCastingForm.php';
        }
}
