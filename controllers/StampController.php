<?php
namespace App\Controllers;
use App\Providers\View;
use App\Models\Color;
use App\Models\Condition;
use App\Models\Contry;

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

    public function create(){
        $colorMod = new Color;
        $condMod = new Condition;
        $contryMod = new Contry;

        $colors = $colorMod->select();
        $conditions = $condMod->select();
        $contries = $contryMod->select();

        return View::render("stamp/create", [
            'privilege_id' => $_SESSION['privilege_id'],
            'user_idUser' => $_SESSION['user_id'],
            'colors' => $colors,
            'conditions' => $conditions,
            'contries' => $contries
        ]);
    }

}