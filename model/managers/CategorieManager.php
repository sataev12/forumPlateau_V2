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

    public function modifierCategorieManager($id) {

        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
        // $id = filter_input(INPU);

        // $sql = "UPDATE ".$this->tableName." c
        //         SET  " 
    }

}