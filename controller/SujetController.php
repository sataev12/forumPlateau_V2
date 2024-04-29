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

class SujetController extends AbstractController implements ControllerInterface {
    
    public function listTopicsByCategory($id) {
        
        $topicManager = new SujetManager();
        $categoryManager = new CategorieManager();
        $categorie = $categoryManager->findOneById($id);
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

    public function ajoutSujet($id){
        $categoryManager = new CategorieManager();
        $utilisateurManager = new UtilisateurManager();
        $ajoutSujetMenager = new AjoutSujetMenager();

        $categorie = $categoryManager->findOneById($id);
        $utilisateurs = $utilisateurManager->findOneById($id);

        return[
            "view" => VIEW_DIR."ajout/ajoutSujet.php",
            "meta_description" => "Ajouter un nouveau sujet",
            "data" => [
                "utilisateurs" => $utilisateurs,
                "categorie" => $categorie
            ]
        ];
    }

    public function ajoutSujetAct($id) {
        $categoryManager = new CategorieManager();
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
        $verouille = 0;
        
        
        $sujetManager = new AjoutSujetMenager();
        $categorie = $categoryManager->findOneById($id);

        if(isset($_POST["submit"]) && ($nom != "")) {

            $userIdConnectee = $_SESSION["user"];
            if(!empty($userIdConnectee)){
                $data = [
                    "titre" => $nom,
                    "categorie_id" => $id,
                    "utilisateur_id" => $userIdConnectee[0]["id_utilisateur"],
                    "verouillee" => $verouille
                ];
                $sujetManager->add($data);
            }else{
                Session::addFlash("error", "veuillez se connceter pour pouvoir crée un sujet");
            }
        }

        return [
            "view" => VIEW_DIR."ajout/ajoutSujet.php",
            "meta_description" => "Formulaire pour ajouter le sujet",
            "data" => [
                "categorie" => $categorie
            ]
        ];
        
    }

    public function listSujet() {
        // créer une nouvelle instance de CategoryManager
        $sujetManager = new SujetManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $sujets = $sujetManager->findAll(["titre", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listSujet.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "sujets" => $sujets
            ]
        ];
    }

    public function supprimerSujet($id) {

        $sujetManager = new SujetManager();
        $sujetManager->delete($id);
        
        $this->redirectTo("sujet", "listSujet");
    }

    public function modifierSujetForm($id){
        $sujetManager = new SujetManager();
        $categorieManager = new CategorieManager();
        $utilisateurManager = new UtilisateurManager();
        
        $sujets = $sujetManager->findOneById($id);
        $categories = $categorieManager->findAll(["nom","DESC"]);
        $utilisateurs = $utilisateurManager->findAll(["pseudonyme", "DESC"]);
        
        return [
            "view" => VIEW_DIR."modifier/modifierSujet.php",
            "meta_description" => "Formulaire pour modifier le sujet",
            "data" => [
                "sujets" => $sujets,
                "categories" => $categories,
                "utilisateurs" => $utilisateurs
            ]
        ];
    }

    public function modifierSujet($id) {
        $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        $sujetManager = new SujetManager;
        
        if(isset($_POST["submit"])) {
            if($titre != "") {
                $data = [
                    "id" => $id,
                    "titre" => $titre,
                ];
                $sujetManager->modifierSujetManager($data);

                $this->redirectTo("forum", "index");
                
            }
           
        }
    }

    public function verouillerSujet($id) {
        $sujetManager = new SujetManager();
        
        $sujetManager->verouillerSujetByUser($id);
        
        $msg = "Sujet est fermée !";
        Session::addFlash('error', $msg);
        
        $this->redirectTo('forum', 'index');
    }
    
    public function deverouillerSujet($id) {
        $sujetManager = new SujetManager();

        $sujetManager->deverouillerSujetByUser($id);

        $msg = "Sujet est ouvert !";
        Session::addFlash('error', $msg);
        $this->redirectTo('forum', 'index');
    }
}