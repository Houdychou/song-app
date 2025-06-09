<?php

namespace App\models;

class Chanson
{
    private $errors = [];
    private $titre_chanson;
    private $annee;
    private $id_categorie;
    private $id_chanteur;

    public function setTitre($titre_chanson)
    {
        if (empty($titre_chanson)) {
            $this->errors["titre_chanson"] = "Le titre de la chanson ne peut pas être vide.";
            return false;
        }

        $this->titre_chanson = $titre_chanson;
        return true;
    }

    public function setAnnee($annee)
    {
        if (empty($annee)) {
            $this->errors["annee"] = "L'année ne peut pas être vide.";
            return false;
        } else if (!is_numeric($annee)) {
            $this->errors["annee"] = "L'année ne peut contenir que des chiffres";
        }

        $this->annee = $annee;
        return true;
    }

    public function setId_categorie($id_categorie)
    {
        if (empty($id_categorie)) {
            $this->errors["id_categorie"] = "L'id de la catégorie ne peut pas être vide.";
        }

        $this->id_categorie = $id_categorie;
        return true;
    }

    public function setId_chanteur($id_chanteur)
    {
        if (empty($id_chanteur)) {
            $this->errors["id_chanteur"] = "L'id du chanteur ne peut pas être vide.";
        }

        $this->id_chanteur = $id_chanteur;
        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}