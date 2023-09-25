<?php
require_once 'app/DAO.php';


class DirectorController
{
    // function qui permet de récupérer la liste de tout les réalisateurs ajoutés en BDD
    public function listDirectors()
    {
        $dao = new DAO();

        $sql = 'SELECT id_director, firstname, lastname, gender, birth_date, is_alive
                FROM director d
                INNER JOIN person p
                ON d.person_id = p.id_person';

        $directors = $dao->executeRequest($sql);
        require 'view/film/listDirectors.php';
    }

    public function viewDirector($id_director)
    {
        $dao = new DAO();

        // $sql = 'SELECT id_director, id_movie, firstname, lastname, title FROM director d
        //         INNER JOIN person p
        //         ON d.person_id = p.id_person
        //         INNER JOIN movie m
        //         ON m.director_id= d.id_director
        //         WHERE id_director = :id
        //         GROUP BY id_director, id_movie, firstname, lastname, title';

        // $sql2 = 'SELECT id_director, firstname, lastname FROM director d
        //         INNER JOIN person p
        //         ON p.id_person=d.person_id
        //         WHERE id_director = :id
        //         GROUP BY firstname, lastname';

        $sqlDirector = 'SELECT id_director, firstname, lastname
            FROM director d
                INNER JOIN person p
                    ON p.id_person = d.person_id
            WHERE id_director = :id';

        $sqlMovies = 'SELECT id_movie, title
            FROM movie
            WHERE director_id = :id';


        $param = [
            'id' => $id_director,
        ];

        $director = $dao->executeRequest($sqlDirector, $param);
        $movies = $dao->executeRequest($sqlMovies, $param);


        require 'view/film/viewDirector.php';
    }

    public function addDirector()
    {
        // Vérifier si le formulaire est soumis
        if (isset($_POST["addDirector"])) {
            // Récupérer les données du formulaire
            $firstname = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastname = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, "date_of_birth", FILTER_SANITIZE_SPECIAL_CHARS);

            $dao = new DAO();

            $sql = "INSERT INTO person (firstname, lastname, gender, birth_date)
                VALUES (:firstname, :lastname, :gender, :birth_date)";

            $param = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'gender' => $gender,
                'birth_date' => $date,
            ];

            $dao->executeRequest($sql, $param);

            // Récupérer l'ID de la personne ajoutée
            $person_id = $dao->getLastInsertId();

            // Insérer dans la table director
            $sql_director = "INSERT INTO director (person_id) VALUES (:person_id)";

            $param_director = [
                'person_id' => $person_id,
            ];

            $dao->executeRequest($sql_director, $param_director);
        }
        require_once 'view/film/addDirectorForm.php';
    }

    public function addDirectorForm()
    {
        require_once 'view/film/addDirectorForm.php';
    }

    public function deleteDirector($id)
    {

        $dao = new DAO();

        // Define the SQL query
        $sql = "DELETE FROM director WHERE id_director = :id";

        // Define the parameter array
        $param = [
            'id' => $id,
        ];

        // Execute the query
        $dao->executeRequest($sql, $param);
        header("Location: index.php?action=listDirectors");
        exit();
    }

    public function modifyDirector($id)
    {
        if (isset($_POST["modifyDirector"])) {

            $firstname = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastname = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, "date_of_birth", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $isFormValidated = true;

            // étape de validation du formulaire (toutes les règles avec message custom)
            if (!isset($firstname) || !$firstname || empty($firstname)) {
                $isFormValidated = false;
                $errorMessages["firstname"] = "The field 'firstname' is mandatory";
            }
            // if ....... (autre règle)


            if ($isFormValidated) {

                $dao = new DAO();

                // Construct the base SQL query
                $sql = "UPDATE person p
                    INNER JOIN director d
                    ON p.id_person = d.person_id
                    SET ";

                $param = [];

                // Build the SET clause and parameter array for each non-empty field
                if (!empty($firstname)) {
                    $sql .= "firstname = :firstname, ";
                    $param['firstname'] = $firstname;
                }

                if (!empty($lastname)) {
                    $sql .= "lastname = :lastname, ";
                    $param['lastname'] = $lastname;
                }

                if (!empty($gender)) {
                    $sql .= "gender = :gender, ";
                    $param['gender'] = $gender;
                }

                if (!empty($date)) {
                    $sql .= "birth_date = :birth_date, ";
                    $param['birth_date'] = $date;
                }

                // Remove the trailing comma and space from the SQL query
                $sql = rtrim($sql, ", ");

                // Add the WHERE clause
                $sql .= " WHERE id_director = :id";

                // Add the id parameter
                $param['id'] = $id;

                // Execute the query
                $dao->executeRequest($sql, $param);
            }
        }

        require 'view/film/modifyDirectorForm.php';
    }

    public function modifyDirectorForm($id)
    {
        require 'view/film/modifyDirectorForm.php';
    }
}
