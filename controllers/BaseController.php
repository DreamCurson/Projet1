<?php
namespace App\Controllers;
use App\Providers\View;

class BaseController{
    public function __construct() {
        session_start();
        if (!isset($_SESSION['privilege_id'])) {
            return View::redirect("login");
        }
    }


    public function index(){
        return View::render("base/index", ['privilege_id' => $_SESSION['privilege_id']]);
    }

}