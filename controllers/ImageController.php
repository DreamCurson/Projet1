<?php
namespace App\Controllers;
use App\Providers\View;

class ImageController{
    public function __construct() {
        session_start();
        if ($_SESSION['privilege_id'] != 1) {
            return View::redirect("login");
        }
    }

    public function index($data){
        $id = array_key_first($data);        
        if (!$id) {
            return View::redirect("login");
        }

        return View::render("image/index", [
            'privilege_id' => $_SESSION['privilege_id'],
            'idStamp' => $id
        ]);
    }

}