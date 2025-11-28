<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Utilisateur;
use App\Providers\Validator;

class AuthController{

    public function index(){
        return View::render("auth/index");
    }

    public function guest(){
    
    }

    public function inscription(){
        return View::render("auth/create");
    }

    public function logout(){
        
    }

}

?>