<?php

require_once "controller/FilmController.php";
require_once "controller/HomeController.php";
require_once "controller/DirectorController.php";


// Appel de la function autoload pour charger automatiquement tout les controllers crées
spl_autoload_register(function ($class_name) {
    require_once 'controller/' . $class_name . '.php';
});

// variable declaration

$ctrFilm = new FilmController();
$ctrHome = new HomeController();
$ctrDirector = new DirectorController();
$ctrActor = new ActorController();



if (isset($_GET['action'])) {

    if (isset($_GET['id'])) {
        // $id = $_GET['id'];
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    }
    switch ($_GET['action']) {
            //insert here all the request to generate new page
        case "listFilms":
            $ctrFilm->listFilms();
            break;
        case "viewMovie":
            $ctrFilm->viewMovie($id);
            break;
        case "listDirectors":
            $ctrDirector->listDirectors();
            break;
        case "viewDirector":
            $ctrDirector->viewDirector($id);
            break;
        case "listActors":
            $ctrActor->listActors();
            break;
        case "viewActor":
            $ctrActor->viewActor($id);
            break;
        case "deleteActor":
            $ctrActor->deleteActor($id);
            break;
        case "modifyActor":
            $ctrActor->modifyActor($id);
            break;
        case "modifyActorForm":
            $ctrActor->modifyActorForm($id);
            break;
        case "addDirector":
            $ctrDirector->addDirector();
            break;
        case "addDirectorForm":
            $ctrDirector->addDirectorForm();
            break;
        case "bestMovie":
            $ctrHome->bestMovie();
            break;
        case "addGenre":
            $ctrFilm->addGenre();
            break;
        case "addGenreForm":
            $ctrFilm->addGenreForm();
            break;
        case "addMovie":
            $ctrFilm->addMovie();
            break;
        case "addMovieForm":
            $ctrFilm->addMovieForm();
            break;
        case "deleteMovie":
            $ctrFilm->deleteMovie($id);
            break;
        case "modifyMovie":
            $ctrFilm->modifyMovie($id);
            break;
        case "modifyMovieForm":
            $ctrFilm->modifyMovieForm($id);
            break;
        case "deleteDirector":
            $ctrDirector->deleteDirector($id);
            break;
        case "modifyDirector":
            $ctrDirector->modifyDirector($id);
            break;
        case "modifyDirectorForm":
            $ctrDirector->modifyDirectorForm($id);
            break;
        case "listRoles":
            $ctrActor->listRoles();
            break;
        case "addRole":
            $ctrActor->addRole();
            break;
        case "addRoleForm":
            $ctrActor->addRoleForm();
            break;
        case "addActor":
            $ctrActor->addActor();
            break;
        case "addActorForm":
            $ctrActor->addActorForm();
            break;
        case "addCasting":
            $ctrFilm->addCasting();
            break;
        case "addCastingForm":
            $ctrFilm->addCastingForm();
            break;
        default:
            //Si l'url de contient pas d'action enregistrer, ont fait appel au constructeur homepage, pour afficher la page d'acceuil par défaut
    }
} else {

    $ctrHome->homePage();
}
