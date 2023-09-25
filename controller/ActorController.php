<?php
require_once 'app/DAO.php';


class ActorController
{
    // function qui permet de récupérer la liste de tout les acteurs ajoutés en BDD
    public function listActors()
    {
        $dao = new DAO();

        $sql = 'SELECT id_actor, firstname, lastname, gender, birth_date, is_alive
                FROM actor a
                INNER JOIN person p
                ON a.person_id = p.id_person';

        $actors = $dao->executeRequest($sql);
        require 'view/film/listActors.php';
    }


    public function viewActor($id_actor)
    {
        $dao = new DAO();

        $sql3 = 'SELECT actor_id, lastname, firstname, title, movie_id FROM casting c
                INNER JOIN actor a
                ON a.id_actor = c.actor_id
                INNER JOIN person p
                ON p.id_person = a.person_id
                INNER JOIN movie m
                ON m.id_movie = c.movie_id
                WHERE id_actor = :id
                GROUP BY actor_id, lastname, firstname, title, movie_id';

        $sql4 = 'SELECT firstname, lastname FROM actor a
                INNER JOIN person p
                ON p.id_person=a.person_id
                WHERE id_actor = :id
                GROUP BY firstname, lastname';

        $param = [
            'id' => $id_actor,
        ];
        $castings = $dao->executeRequest($sql3, $param);
        $actor = $dao->executeRequest($sql4, $param);

        require 'view/film/viewActor.php';
    }

    public function listRoles()
    {
        $dao = new DAO();

        $sql = 'SELECT id_role, name
                FROM role';


        $listRoles = $dao->executeRequest($sql);
        require 'view/film/listRoles.php';
    }

    public function addRole()
    {
        if (isset($_POST["addRole"])) {

            // Récupérer les données du formulaire
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $dao = new DAO();

            $sql = "INSERT INTO role (name)
                    VALUES (:name)";

            $param = [
                'name' => $name,
            ];

            $addRole = $dao->executeRequest($sql, $param);
        }

        require 'view/film/addRoleForm.php';
    }

    public function addRoleForm()
    {
        require 'view/film/addRoleForm.php';
    }

    public function addActor()
    {
        // Vérifier si le formulaire est soumis
        if (isset($_POST["addActor"])) {
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

            // Insérer dans la table actor
            $sql_actor = "INSERT INTO actor (person_id) VALUES (:person_id)";

            $param_actor = [
                'person_id' => $person_id,
            ];

            $dao->executeRequest($sql_actor, $param_actor);
        }
        require 'view/film/addActorForm.php';
    }

    public function addActorForm()
    {
        require 'view/film/addActorForm.php';
    }

    public function deleteActor($id)
    {

        $dao = new DAO();

        // Define the SQL query
        $sql = "DELETE FROM actor WHERE id_actor = :id";

        // Define the parameter array
        $param = [
            'id' => $id,
        ];

        // Execute the query
        $dao->executeRequest($sql, $param);
        header("Location: index.php?action=listActors");
        exit();
    }
    public function modifyActor($id)
    {
        if (isset($_POST["modifyActor"])) {

            $firstname = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastname = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, "date_of_birth", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $dao = new DAO();

            // Construct the base SQL query
            $sql = "UPDATE person p
                INNER JOIN actor a
                ON p.id_person = a.person_id
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
            $sql .= " WHERE id_actor = :id";

            // Add the id parameter
            $param['id'] = $id;

            // Execute the query
            $dao->executeRequest($sql, $param);
        }

        require 'view/film/modifyActorForm.php';
    }

    public function modifyActorForm($id)
    {
        require 'view/film/modifyActorForm.php';
    }
}
