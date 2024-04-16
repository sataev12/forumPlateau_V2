<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\SujetManager;
use Model\Managers\AjoutSujetMenager;
use Model\Managers\UtilisateurManager;

class SujetController extends AbstractController implements ControllerInterface {
    
    public function listTopicsByCategory($id) {
        
        $topicManager = new SujetManager();
        $categoryManager = new CategorieManager();
        $categorie = $categoryManager->findOneById($id);
        //var_dump($categorie);die;
        $sujets = $topicManager->findTopicsByCategory($id);

    

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$categorie,
            "data" => [
                "categorie" => $categorie,
                "sujets" => $sujets
            ]
        ];
    }

    public function ajoutSujet(){
        $utilisateurManager = new UtilisateurManager();
        $ajoutSujetMenager = new AjoutSujetMenager();

        $ajoutSuj = $ajoutSujetMenager->ajoutSujetFunction();

        return[
            "view" => VIEW_DIR."ajout/ajoutSujet.php",
            "meta_description" => "Ajouter un nouveau sujet",
            "data" => [
                
            ]
        ];
    }
}