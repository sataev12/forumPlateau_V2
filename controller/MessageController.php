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

    public function listMessageBySujet($id) {

        $messageManager = new MessageManager();
        $sujetManager = new SujetManager();
        $sujet = $sujetManager->findOneById($id);

        $messages = $messageManager->findlistMessageBySujet($id);

        return [
            "view" => VIEW_DIR."forum/listMessage.php",
            "meta_description" => "Liste des messages par sujet : ".$sujet,
            "data" => [
                "messages" => $messages,
                "sujet" => $sujet
            ]
            ];
    }

    public function ajoutMessage($id) {
        if(!empty($_SESSION['user'])){
            if(isset($_POST["submit"])) {
                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $userIdConnectee = $_SESSION["user"];
                $postManager = new MessageManager();
                $data = [
                    "texte" => $texte,
                    "sujet_id" => $id,
                    "utilisateur_id" => $userIdConnectee[0]["id_utilisateur"]
                ];
                $postManager->add($data);
                Session::addFlash("success", "Message envoyée");
                $this->redirectTo("message", "listMessageBySujet", "$id");
            }
            //var_dump(Session::getUser()[0]["id_utilisateur"]);
        }elseif (empty($_SESSION['user'])) {
            Session::addFlash("error", "Que les utilisateurs connectée peuvent envoyer les message");
            $this->redirectTo("message", "listMessageBySujet", "$id");
        }
        

        
       
    }

    

}