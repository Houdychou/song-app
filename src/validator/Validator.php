<?php

namespace App\validator;

class Validator
{
    private $isValid = false;
    private $errors = [];

    public function validate($data, $model)
    {
        $pathModel = $model;
        if (!class_exists($pathModel)) {
            throw new \Exception("Model class $model does not exist");
        }

        $modelInstance = new $pathModel();

        foreach ($data as $key => $value) {
            $setterName = 'set' . ucfirst($key);
            if (method_exists($model, $setterName)) {
                $modelInstance->$setterName($value);
            }
        }
        if (!$modelInstance->getErrors()) {
            $this->isValid = true;
            return;
        }

        $this->errors = $modelInstance->getErrors();
    }

    public function isValid()
    {
        return $this->isValid;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}