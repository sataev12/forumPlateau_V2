<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategorieManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Categorie";
    protected $tableName = "Categorie";

    public function __construct(){
        parent::connect();
    }

    public function modifierCategorieManager($data) {
        
            $sql = "UPDATE ".$this->tableName." 
                    SET nom = :nom
                    WHERE id_categorie = :id";

            DAO::update($sql, $data);
        }

    

}