<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Utilisateur extends Entity{

    private $id;
    private $pseudonyme;
    private $role;
    private $motDePasse;
    private $email;
    private $bannir;

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


    public function __toString() {
        return $this->pseudonyme;
    }

    /**
     * Get the value of pseudonyme
     */ 
    public function getPseudonyme()
    {
        return $this->pseudonyme;
    }

    /**
     * Set the value of pseudonyme
     *
     * @return  self
     */ 
    public function setPseudonyme($pseudonyme)
    {
        $this->pseudonyme = $pseudonyme;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of motDePasse
     */ 
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Set the value of motDePasse
     *
     * @return  self
     */ 
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of bannir
     */ 
    public function getBannir()
    {
        return $this->bannir;
    }

    /**
     * Set the value of bannir
     *
     * @return  self
     */ 
    public function setBannir($bannir)
    {
        $this->bannir = $bannir;

        return $this;
    }

    public function hasRole($role)
    {
        
        $result = (in_array($role, str_replace(" ", "",explode(",",$this->role)))) ? true : false;
        return $result;
    }
}