<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\SujetManager;


class CategorieController extends AbstractController implements ControllerInterface {

    public function ajoutCategorie() {
        
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $categorieManager = new CategorieManager();
        if(isset($_POST["submit"])) {
            
            if($nom != "") {
                
                $data = ['nom' => $nom];
                $categorieManager->add($data);
            }
        }
        // $data = ['nom' => 'test'];
        
        // $categorieManager->add($data);

        return[
            "view" => VIEW_DIR."ajout/ajoutCategories.php",
            "meta_description" => "Ajouter un nouveau categorie",
            "data" => [
                
            ]
        ];

        
    }

    public function supprimerCategorie($id) {
        
        $categorieManager = new CategorieManager();
        $categorieManager->delete($id);
        

        $this->redirectTo("forum","index");
    
    }


    public function modifierCategorie($id) {

        
        $categoryManager = new CategorieManager();
        
        $categories = $categoryManager->findOneById($id);
        return [
            "view" => VIEW_DIR."modifier/modifieCategorie.php",
            "meta_description" => "Formulaire pour modifier le categorie",
            "data" => [
                "categories" => $categories
            ]
        ];
        
    }

    public function modifierCategorieAct($id){
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        
        $categorieManager = new CategorieManager;
        

        if(isset($_POST["submit"])) {
          
           
            if($nom !== "" && !empty($_SESSION['user'])){
                $data = [
                    "id" => $id,
                    "nom" => $nom
                ];
                $categorieManager->modifierCategorieManager($data);
                Session::addFlash("success", "Categorie est bien modifié");
                $this->redirectTo("forum", "index");
                
            }else{
                Session::addFlash("success", "Que les utilisateur connectées ou admin de site ont droit de modifier les categorie");
            }
           
        }
    }   

}