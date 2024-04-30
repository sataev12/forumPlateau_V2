<?php
namespace Controller;
use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\MessageManager;
use Model\Managers\SujetManager;
use Model\Managers\UtilisateurManager;


class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout
    
    public function register () {
        $utilisateurManager = new UtilisateurManager;
        if(isset($_POST["submit"])) {
            
            // Filtrer la saisie des champs du formulaire d'inscription
            $pseudonyme = filter_input(INPUT_POST, "pseudonyme", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasse = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasse2 = filter_input(INPUT_POST, "motDePasse2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $role = "role_user";

            if($pseudonyme && $email && $motDePasse && $motDePasse2) {
                $utilisateur = $utilisateurManager->findUserByEmail($email);
                // Si l'utilisateur existe
                if(empty($utilisateur)){
                   var_dump("utilisateur n'existe pas");
                    // insertion de l'utilisateur dans BDD
                    if($motDePasse == $motDePasse2 && strlen($motDePasse) >= 12){
                        $data = [
                            'pseudonyme' => $pseudonyme,
                            'email' => $email,
                            'motDePasse' => password_hash($motDePasse, PASSWORD_DEFAULT),
                            'role' => $role
                        ];
                        $utilisateurManager->add($data);
                        $this->redirectTo("forum", "index");
                    }else{
                        echo "<p>"."les mot des passe ne sont pas identique ou trop court"."</p>";
                    }
                }
            }else{
                echo "<p>"."probleme de saisie dans les champs de formulaire"."</p>";
            }
        }
        return [
            "view" => VIEW_DIR."connect/register.php",
            "meta_description" => "Une formulaire d'inscription",
            "data" => [
               
            ]
        ];
    }


    // methode login, pour se connecté si l'utilisateur a déjà la compte
    public function login () {
        $session = new Session();
        if ($session::getUser()!= false){
            $this->redirectTo("home");
        }
        $utilisateurManager = new UtilisateurManager;

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // si les filtres sont valide
        if($email && $password) {
            
            $utilisateur = $utilisateurManager->findUserByEmail($email);
            //var_dump($utilisateur);die;
            
            // si l'utilisateur existe
            if(!empty($utilisateur)) {
                
                $hash = $utilisateur->getMotDePasse();
                //var_dump($hash);die;
                
                if(password_verify($password, $hash)) {
                    $_SESSION["user"] = $utilisateur;
                    $this->redirectTo("forum", "index");
                }else{
                    echo "<p>"."utilisateur inconnu ou mot de passe est incorrect"."</p>";
                }
            }else{
                echo "<p>"."utilisateur inconnu ou mot de passe est incorrect"."</p>";
            }
        }

        return [
            "view" => VIEW_DIR."connect/connexion.php",
            "meta_description" => "Une formulaire de connexion",
            "data" => [
                 
            ]
        ];
    }


    public function logout () {
        
        if(!empty($_SESSION["user"])){
            unset($_SESSION["user"]);
            Session::addFlash("success", "Logout réussi");
            $this->redirectTo("forum", "index");
        }
        
    }

    public function profile() {
        
        $sujetManager = new SujetManager();
        $utilisateurManager = new UtilisateurManager();
        $messageManager = new MessageManager();
        $utilisateurActiv = $_SESSION['user'];
        $userId = $utilisateurActiv->getId();
        
        
        $sujets = $sujetManager->findListSujetByUserId($userId);
        $messages = $messageManager->findMessageByUserId($userId);
        return [
            "view" => VIEW_DIR."profil/profil.php",
            "meta_description" => "Mon profil",
            "data" => [
                "sujets" => $sujets, 
                "message" => $messages
            ]
        ];

    }

    public function bannir($id) {
        
        $utilisateurManager = new UtilisateurManager();

        $utilisateurBan = $utilisateurManager->findOneById($id);
        $valeurBan = $utilisateurBan->getBannir();
        if($valeurBan == "0"){
            $utilisateurManager->bannirUtilisateur($id);

            Session::addFlash("success", "Utilisateur est bloquée ");
            $this->redirectTo("security", "profile", "$id");
        }else if($valeurBan == "1") {
            $utilisateurManager->debloquer($id);
        }
        
    }
}