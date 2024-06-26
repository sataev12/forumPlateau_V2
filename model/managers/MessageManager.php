<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class MessageManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Message";
    protected $tableName = "Message";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findlistMessageBySujet($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." m 
                WHERE m.sujet_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function findMessageByUserId($userId) {

        $sql = "SELECT *
                FROM ".$this->tableName." m
                WHERE m.utilisateur_id = :id";
        return $this->getMultipleResults(
            DAO::select($sql, ['id'=>$userId]),
            $this->className
        );
    }

    public function modifierMessage($data) {
        
        $sql = "UPDATE ".$this->tableName."
                SET texte = :texte
                WHERE id_message = :id";
        DAO::update($sql, $data);
    }
}