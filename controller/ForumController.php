<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\SujetManager;
use Model\Managers\MessageManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategorieManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["nom", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }



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

    public function listMessageBySujet($id) {

        $messageManager = new MessageManager();
        $sujetManager = new SujetManager();
        $sujet = $sujetManager->findOneById($id);

        $messages = $messageManager->findlistMessageBySujet($id);

        return [
            "view" => VIEW_DIR."forum/listMessage.php",
            "meta_description" => "Liste des messages par sujet : ".$sujet,
            "data" => [
                "messages" => $messages
            ]
            ];
    }

}