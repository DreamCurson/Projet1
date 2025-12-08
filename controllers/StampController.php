<?php
namespace App\Controllers;
use App\Providers\View;

class StampController{
    public function __construct() {
        session_start();
        if ($_SESSION['privilege_id'] != 1) {
            return View::redirect("login");
        }
    }

    public function index(){
        return View::render("stamp/index", ['privilege_id' => $_SESSION['privilege_id']]);
    }

}