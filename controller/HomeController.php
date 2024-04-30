<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UtilisateurManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index(){
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum"
        ];
    }


        
    public function users(){
        
        $this->restrictTo("role_user");
        $manager = new UtilisateurManager();
        $users = $manager->findAll(['dateInscription', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }
}
