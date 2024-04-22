<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UtilisateurManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Utilisateur";
    protected $tableName = "Utilisateur";

    public function __construct(){
        parent::connect();
    }

    public function findUserByEmail($email) {
        $sql = "SELECT *
                FROM ".$this->tableName." u
                WHERE u.email = :email";
    }
}