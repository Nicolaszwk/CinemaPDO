<?php
require_once 'app/DAO.php';

class HomeController
{
    // function permettant d'afficher les 5 films les plus récents ainsi que les 5 films les mieux notés
    public function homePage()
    {
        $dao = new DAO();

        $sql = "SELECT id_movie, title, DATE_FORMAT(release_date, '%Y') dateRealease, TIME_FORMAT(SEC_TO_TIME(duration*60),'%H:%i') duration, notation, poster 
        FROM movie
        ORDER BY release_date DESC
        LIMIT 5";

        $sql2 = "SELECT id_movie, title, notation, poster FROM movie
        ORDER BY notation DESC
        LIMIT 5";

        $most_recent = $dao->executeRequest($sql);
        $bestMovie = $dao->executeRequest($sql2);
        require 'view/home/home.php';
    }
}
