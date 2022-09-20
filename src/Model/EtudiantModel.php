<?php

namespace Quizz\Model;

use Quizz\Core\Service\DatabaseService;
use Quizz\Entity\Etudiant;

class EtudiantModel
{
    private $bdd;

    public function __construct()
    {
        //get db access
        $this->bdd= DatabaseService::getConnect();
    }

    public function getFecthAll(){
        //set the request and execute it
        $requete = $this->bdd->prepare('SELECT * FROM etudiants');
        $requete->execute();
        //create an array for etudiants's data
        $tabEtudiants = [];

        foreach ($requete->fetchAll() as $value) {
            //set the non private data
            $etudiant = new Etudiant();
            $etudiant->setIdEtudiant($value["idEtudiant"]);
            $etudiant->setNom($value["nom"]);
            $etudiant->setPrenom($value["prenom"]);
            $etudiant->setLogin($value["login"]);
            $tabEtudiants[] = $etudiant;
        }

        return $tabEtudiants;
    }

    public function getFetchId(int $id){
        //only get the id's data
        $requete = $this->bdd->prepare('SELECT * FROM etudiants where idEtudiant ='. $id);
        $requete->execute();
        $result = $requete->fetch();

        $etudiant = new Etudiant();
        $etudiant->setIdEtudiant($result["idEtudiant"]);
        $etudiant->setNom($result["nom"]);
        $etudiant->setPrenom($result["prenom"]);
        $etudiant->setLogin($result["login"]);

        return $etudiant;
    }

    public function updateEtudiant(string $nom,string $prenom,int $id){
        $requete = $this->bdd->prepare(/*'Update etudiants SET nom,prenom WHERE
                                     idEtudiant = '.$id.''*/
            "UPDATE etudiants
            SET nom = '".$nom."', prenom = '".$prenom."'
            WHERE idEtudiant = ". $id.";");
        $requete->execute();
    }

    public function createEtudiant(string $login,string $nom,string $prenom,string $email,string $mdp){
        $requete = $this->bdd->prepare("INSERT INTO etudiants 
            (login,nom,prenom,email,mdp) 
            VALUES('".$login."','".$nom."','".$prenom."','".$email."','".$mdp."');");
        $requete->execute();
    }

    public function deleteEtudiant(int $id){
        $requete=$this->bdd->prepare('DELETE FROM etudiants 
            WHERE idEtudiant ='. $id);
        $requete->execute();
    }
}