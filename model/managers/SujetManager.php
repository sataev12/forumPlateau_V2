<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class SujetManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Sujet";
    protected $tableName = "Sujet";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." s 
                WHERE s.categorie_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className 
        );
    }

    public function modifierSujetManager($data) {

        $sql = "UPDATE ".$this->tableName." 
                    SET titre = :titre 
                    WHERE id_sujet = :id";

            DAO::update($sql, $data);
    }
}