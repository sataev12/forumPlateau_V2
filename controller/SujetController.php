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
        $utilisateurs = $utilisateurManager->findAll(["pseudonyme", "DESC"]);

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
        
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
        $categorieId = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        $utilisateurId = filter_input(INPUT_POST, 'utilisateur', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $sujetManager = new AjoutSujetMenager();

        if(isset($_POST["submit"]) && ($nom != "") && ($categorieId != "") && ($utilisateurId != "")) {
            
            $data = [
                "titre" => $nom,
                "categorie_id" => $id,
                "utilisateur_id" => $utilisateurId 
            ];
            $sujetManager->add($data);
            $this->redirectTo("sujet", "ajoutSujet");
        }

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
}