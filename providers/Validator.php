<?php
namespace App\Providers;
use App\Models;

class Validator {
    private $errors = array();
    private $key;
    private $value;
    private $name;

    public function field($key, $value, $name = null){
        $this->key = $key;
        $this->value = $value;
        if($name == null){
            $this->name = ucfirst($key);
        }else{
            $this->name = ucfirst($name);
        }
        return $this;
    }

    public function required(){
        if(empty($this->value)){
            $this->errors[$this->key]="Veuillez remplir se champ";
        }
        return $this;
    }

    public function max($length){
        if (!empty($this->value) && strlen($this->value) > $length) {
            $this->errors[$this->key] = "Doit contenir moins que $length caractères.";
        }
        return $this;
    }

    public function min($length){
        if (!empty($this->value) && strlen($this->value) < $length) {
            $this->errors[$this->key] = "Doit contenir plus que $length caractères.";
        }
        return $this;
    }

    public function int(){
        if(!filter_var($this->value, FILTER_VALIDATE_INT)){
            $this->errors[$this->key]="Doit être un nombre";
        }
        return $this;
    }

    public function email() {
        if (!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$this->key]="Doit être un email ex: exemple@gmail.com";
        }
        return $this;
    }

    public function unique($model) {
        $model = 'App\\Models\\'.$model;
        $model = new $model;
        
        // Appelle la méthode unique du CRUD pour vérifier si la valeur est unique
        $unique = $model->unique($this->key, $this->value);
        
        // Si la valeur n'est pas unique (le modèle retourne une valeur)
        if ($unique) {
            $this->errors[$this->key] = "$this->name déjà utilisé";
        }
        
        return $this; 
    }

    public function afterDate($compareDate) {
        $this->value = trim($this->value);
        $compareDate = trim($compareDate);

        $timezone = new \DateTimeZone('UTC');
        
        $dateStart = \DateTime::createFromFormat('Y-m-d', $compareDate, $timezone);
        $dateEnd = \DateTime::createFromFormat('Y-m-d', $this->value, $timezone);

        if (!$dateStart || !$dateEnd) {
            $this->errors[$this->key] = "Les dates sont au format incorrect.";
            return $this;
        }

        if ($dateEnd <= $dateStart) {
            $this->errors[$this->key] = "La date de fin doit être après la date de début";
        }

        return $this;
    }




    public function isSuccess(){
        if(empty($this->errors)) return true;
    }

    public function getErrors(){
        if(!$this->isSuccess()) return $this->errors;
    }
}

?>

