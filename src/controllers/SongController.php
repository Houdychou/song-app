<?php

namespace App\controllers;

use App\manager\EntityManager;
use App\models\Chanson;
use App\validator\Validator;

class SongController extends Controller
{
    private $entityManager;
    private $errors = [];
    private $validator;

    public function __construct()
    {
        $this->entityManager = new EntityManager();
        $this->validator = new Validator();
    }

    public function index()
    {
        $chanson = $this->entityManager->findChansonWithJoin("chanson");
        $chanteur = $this->entityManager->findAll("chanteur");
        $categorie = $this->entityManager->findAll("categorie");
        $this->renderPhpView("home.php", ["chansons" => $chanson, "chanteurs" => $chanteur, "categories" => $categorie]);
    }

    public function addSong()
    {
        $chansonData = [
            "titre" => $_POST['titre'],
            "annee" => $_POST['annee'],
            "id_categorie" => $_POST['categorie'],
            "id_chanteur" => $_POST['chanteur'],
        ];

        $this->validator->validate($chansonData, Chanson::class);

        if (!$this->validator->isValid()) {
            $this->errors += $this->validator->getErrors();
        }

        if (!empty($this->errors)) {
            return json_encode([
                "success" => false,
                "errors" => $this->errors
            ]);
        }

        $this->entityManager->create("chanson", $chansonData);

        return json_encode([
            "success" => true,
            "message" => "Chanson ajoutée avec succès!"
        ]);
    }

    public function deleteSong($id)
    {
        $this->entityManager->delete("chanson", "id_chanson", $id);
        header("location: /");
        exit();
    }

    public function updatePage($id)
    {
        $chansons = $this->entityManager->findChansonWithJoinAndId("id_chanson", $id);
        $chanteur = $this->entityManager->findAll("chanteur");
        $categorie = $this->entityManager->findAll("categorie");

        $chanson = $chansons[0];
        $this->renderPhpView("update-song.php", ["chanson" => $chanson, "chanteurs" => $chanteur, "categories" => $categorie]);
    }

    public function updateSong($id)
    {
        $chansonData = [
            "titre" => $_POST['titre'],
            "annee" => $_POST['annee'],
            "id_categorie" => $_POST['categorie'],
            "id_chanteur" => $_POST['chanteur'],
        ];

        $this->validator->validate($chansonData, Chanson::class);

        if (!$this->validator->isValid()) {
            $this->errors += $this->validator->getErrors();
        }

        if (!empty($this->errors)) {
            return json_encode([
                "success" => false,
                "errors" => $this->errors
            ]);
        }

        $this->entityManager->update("chanson", $chansonData, "id_chanson", $id);

        return json_encode([
            "success" => true,
            "message" => "Chanson modifiée avec succès"
        ]);
    }
}