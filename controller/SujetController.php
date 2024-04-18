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

    public function ajoutSujet(){
        var_dump("ok");
        $categoryManager = new CategorieManager();
        $utilisateurManager = new UtilisateurManager();
        $ajoutSujetMenager = new AjoutSujetMenager();

        $categories = $categoryManager->findAll(["nom", "DESC"]);
        $utilisateurs = $utilisateurManager->findAll(["pseudonyme", "DESC"]);

        return[
            "view" => VIEW_DIR."ajout/ajoutSujet.php",
            "meta_description" => "Ajouter un nouveau sujet",
            "data" => [
                "categories" => $categories,
                "utilisateurs" => $utilisateurs
            ]
        ];
    }

    public function ajoutSujetAct() {
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
        $categorieId = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        $utilisateurId = filter_input(INPUT_POST, 'utilisateur', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $sujetManager = new AjoutSujetMenager();

        if(isset($_POST["submit"]) && ($nom != "") && ($categorieId != "") && ($utilisateurId != "")) {
            
            $data = [
                "titre" => $nom,
                "categorie_id" => $categorieId,
                "utilisateur_id" => $utilisateurId 
            ];
            $sujetManager->add($data);
            $this->redirectTo("sujet", "ajoutSujet");
        }

    }
}