<?php
namespace App\Models;
use App\Models\CRUD;

class User extends CRUD {
    protected $table = "user";
    protected $primaryKey = "idUser";
    // idUser, name, email, password, permision_idPermission 
    protected $fillable = ['name', 'email', 'password', 'permision_idPermission']; 

    /**
     * Hache un mot de passe en utilisant l'algorithme BCRYPT.
     * Le paramètre cost détermine la durée du calcul du hachage (nombre d'itérations)
     */
    public function hashPassword($motDePasse, $cost = 10){
        $options = [ 
            'cost' => $cost
        ];
        return password_hash($motDePasse, PASSWORD_BCRYPT, $options);
    }
}


?>