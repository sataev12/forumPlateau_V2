<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Sujet extends Entity{

    private $id;
    private $titre;
    private $dateCreation;
    private $categorie;
    private $utilisateur;
    private $verouillee;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitre(){
        return $this->titre;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitre($titre){
        $this->titre = $titre;
        return $this;
    }

   

    public function __toString(){
        return $this->titre;
    }

    /**
     * Get the value of categorie_id
     */ 
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie_id
     *
     * @return  self
     */ 
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get the value of utilisateur_id
     */ 
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set the value of utilisateur_id
     *
     * @return  self
     */ 
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get the value of dateCreation
     */ 
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set the value of dateCreation
     *
     * @return  self
     */ 
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get the value of verouillee
     */ 
    public function getVerouillee()
    {
        return $this->verouillee;
    }

    /**
     * Set the value of verouillee
     *
     * @return  self
     */ 
    public function setVerouillee($verouillee)
    {
        $this->verouillee = $verouillee;

        return $this;
    }
}