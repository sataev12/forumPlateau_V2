<?php
namespace Controller;
use App\AbstractController;
use App\ControllerInterface;
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
                            'motDePasse' => password_hash($motDePasse, PASSWORD_DEFAULT)
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

        $utilisateurManager = new UtilisateurManager;

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // si les filtres sont valide
        if($email && $password) {
            
            $utilisateur = $utilisateurManager->findUserByEmail($email);
            
            // si l'utilisateur existe
            if(!empty($utilisateur)) {
                
                $hash = $utilisateur[0]["motDePasse"];
                
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
    public function logout () {}
}