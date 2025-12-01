<?php
namespace App\Controllers;
use App\Providers\View;

class BaseController{
    public function __construct() {
        session_start();
        if ($_SESSION['privilege_id'] == null){
            return View::render("auth/index");
        }
    }

    public function index(){
        return View::render("base/index", ['privilege_id' => $_SESSION['privilege_id']]);
    }

}