<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Entities\Utilisateur;
use Model\Managers\CategorieManager;
use Model\Managers\SujetManager;
use Model\Managers\AjoutSujetMenager;
use Model\Managers\UtilisateurManager;
use Model\Managers\MessageManager;

class MessageController extends AbstractController implements ControllerInterface {

    public function listMessage(){
        // créer une nouvelle instance de CategoryManager
        $messageManager = new MessageManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $messages = $messageManager->findAll(["texte", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listMessage.php",
            "meta_description" => "Liste des messages du forum",
            "data" => [
                "messages" => $messages
            ]
        ];
    }

    

}