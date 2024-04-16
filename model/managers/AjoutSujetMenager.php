<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class AjoutSujetMenager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Sujet";
    protected $tableName = "Sujet";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function ajoutSujetFunction() {

        $sql = "SELECT * 
                FROM ".$this->tableName." s";
               
       
       
    }
}