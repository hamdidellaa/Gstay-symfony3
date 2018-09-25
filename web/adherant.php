<?php


class adherent
{
    private $Num_adh ;
    private $Nom_adh ;
    private $Prenom_adh;
    private $Date_naiss ;
    private $Lieu_naiss ;
    private $etat_civil ;
    private $nbr_enfant ;
    private $Profession ;
    private $Administration;
    private $Service;
    private $Permis ;
    private $CIN;
    private $ville ;
    private $Matricule ;
    private $Email ;
    private $mot_de_passe ;





    public function __construct($Nom_adh, $Prenom_adh,$Email, $mot_de_passe, $Date_naiss, $Lieu_naiss, $etat_civil, $nbr_enfant, $Profession, $Administration, $Service, $Permis, $CIN, $ville, $Matricule)
    {
        $this->Nom_adh = $Nom_adh;
        $this->Prenom_adh = $Prenom_adh;
        $this->Date_naiss = $Date_naiss;
        $this->Lieu_naiss = $Lieu_naiss;
        $this->etat_civil = $etat_civil;
        $this->nbr_enfant = $nbr_enfant;
        $this->Profession = $Profession;
        $this->Administration = $Administration;
        $this->Service = $Service;
        $this->Permis = $Permis;
        $this->CIN = $CIN;
        $this->ville = $ville;
        $this->Matricule = $Matricule;
        $this->Email = $Email;
        $this->mot_de_passe = $mot_de_passe;
    }


    public function getNomAdh()
    {
        return $this->Nom_adh;
    }

    public function setNomAdh($Nom_adh)
    {
        $this->Nom_adh = $Nom_adh;
    }

    public function getPrenomAdh()
    {
        return $this->Prenom_adh;
    }

    public function setPrenomAdh($Prenom_adh)
    {
        $this->Prenom_adh = $Prenom_adh;
    }

    public function getDateNaiss()
    {
        return $this->Date_naiss;
    }

    public function setDateNaiss($Date_naiss)
    {
        $this->Date_naiss = $Date_naiss;
    }

    public function getLieuNaiss()
    {
        return $this->Lieu_naiss;
    }

    public function setLieuNaiss($Lieu_naiss)
    {
        $this->Lieu_naiss = $Lieu_naiss;
    }

    public function getEtatCivil()
    {
        return $this->etat_civil;
    }

    public function setEtatCivil($etat_civil)
    {
        $this->etat_civil = $etat_civil;
    }

    public function getNbrEnfant()
    {
        return $this->nbr_enfant;
    }

    public function setNbrEnfant($nbr_enfant)
    {
        $this->nbr_enfant = $nbr_enfant;
    }

    public function getProfession()
    {
        return $this->Profession;
    }

    public function setProfession($Profession)
    {
        $this->Profession = $Profession;
    }

    public function getAdministration()
    {
        return $this->Administration;
    }

    public function setAdministration($Administration)
    {
        $this->Administration = $Administration;
    }

    public function getService()
    {
        return $this->Service;
    }

    public function setService($Service)
    {
        $this->Service = $Service;
    }

    public function getPermis()
    {
        return $this->Permis;
    }

    public function setPermis($Permis)
    {
        $this->Permis = $Permis;
    }

    public function getCIN()
    {
        return $this->CIN;
    }

    public function setCIN($CIN)
    {
        $this->CIN = $CIN;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function getMatricule()
    {
        return $this->Matricule;
    }

    public function setMatricule($Matricule)
    {
        $this->Matricule = $Matricule;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse($mot_de_passe)
    {
        $this->mot_de_passe = $mot_de_passe;
    }





}