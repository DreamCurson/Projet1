<?php
namespace App\Controllers;
use App\Providers\View;

class ClientController{
    public function __construct() {
        session_start();
        if (!isset($_SESSION['privilege_id']) || $_SESSION['privilege_id'] != 1) {
            return View::redirect("login");
        }
    }

    public function index(){
        return View::render("client/index");
    }

}