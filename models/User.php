<?php
namespace App\Models;
use App\Models\CRUD;

class User extends CRUD {
    protected $table = "user";
    protected $primaryKey = "idUser";
    // idUser, name, email, password, permision_idPermission 
    protected $fillable = ['name', 'email', 'password']; 
}


?>