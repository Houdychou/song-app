<?php

namespace App\manager;

use App\Config\Database;
use App\validator\Validator;
use PDO;

class EntityManager extends Database
{
    public function findAll($table)
    {
        $sql = "SELECT * FROM `" . $table . "`";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findChansonWithJoin() {
        $sql = "SELECT * FROM chanson INNER JOIN chanteur ON chanson.id_chanteur = chanteur.id_chanteur INNER JOIN categorie ON chanson.id_categorie = categorie.id_categorie";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findChansonWithJoinAndId($idName, $idValue) {
        $sql = "SELECT * FROM chanson INNER JOIN chanteur ON chanson.id_chanteur = chanteur.id_chanteur INNER JOIN categorie ON chanson.id_categorie = categorie.id_categorie where $idName = '$idValue'";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByAttribute($table, $attributeName, $attributeValue)
    {
        $sql = "SELECT * FROM `" . $table . "` WHERE " . $attributeName . " = :attributeValue";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->bindParam(':attributeValue', $attributeValue);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($table, $data)
    {
        $fields = '';
        $values = '';
        foreach ($data as $key => $value) {
            $fields = $fields . $key . ', ';
            $values = $values . "'$value'" . ', ';
        }
        $sql = "INSERT INTO `" . $table . "` (" . rtrim($fields, ', ') . ") VALUES (" . rtrim($values, ', ') . ")";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute();
    }

    public function delete($table, $idName, $idValue)
    {
        $sql = "DELETE FROM `" . $table . "` WHERE " . $idName . " = :id";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->bindParam(':id', $idValue);
        $stmt->execute();
    }

    public function update($table, $data, $idName, $idValue)
    {
        $fieldValues = '';
        foreach ($data as $key => $value) {
            $fieldValues = $fieldValues . ", " . $key . " = " . "'$value'";
        }

        $sql = "UPDATE `" . $table . "` SET " . substr($fieldValues, 1) . " WHERE " . $idName . " = :id";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->bindParam(':id', $idValue);
        $stmt->execute();
    }

}