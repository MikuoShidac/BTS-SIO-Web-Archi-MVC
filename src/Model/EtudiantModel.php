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
        //create an array for etudiant's data
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
        $etudiant->setIdEtudiant($result["IdEtudiant"]);
        $etudiant->setNom($result["Nom"]);
        $etudiant->setPrenom($result["Prenom"]);
        $etudiant->setLogin($result["Login"]);

        return $etudiant;
    }
}