<?php

use App\validator\Validator;
use PHPUnit\Framework\TestCase;
use App\models\Chanson;

class SongTest extends TestCase
{
    public function testValidationEchoueAvecTitreVide()
    {
        $validator = new Validator();
        $data = [
            'titre' => '',             // invalide
            'annee' => '2020',           // valide
            'id_categorie' => 1,         // valide
            'id_chanteur' => 2           // valide
        ];

        $validator->validate($data, Chanson::class);

        $this->assertFalse($validator->isValid());
        $this->assertArrayHasKey('titre_chanson', $validator->getErrors());
    }

    public function testValidationReussie() {
        $validator = new Validator();
        $data = [
            "titre" => "Chanson valide",
            "annee" => "2020",
            "id_categorie" => 1,
            "id_chanteur" => 2
        ];

        $validator->validate($data, Chanson::class);
        $this->assertTrue($validator->isValid());
        $this->assertEmpty($validator->getErrors());
    }
}
