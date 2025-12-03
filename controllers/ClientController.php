<?php
namespace App\Controllers;
use App\Providers\View;
use App\Models\User;

class ClientController{
    public function __construct() {
        session_start();
        if (!isset($_SESSION['privilege_id']) || $_SESSION['privilege_id'] != 1) {
            return View::redirect("login");
        }
    }

    public function index($id = null){
        if ($id === null && isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }else{
            return View::render('login');
        }

        $utilisateur = new User;
        $selectId = $utilisateur->selectId($id);

        if ($selectId) {
            return View::render("client/index", ['utilisateur' => $selectId, 'privilege_id' => $_SESSION['privilege_id']]);
        }else{
            return view::render('error');
        }
    }

    public function edit($id = null){
        if ($id === null && isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }else{
            return View::render('login');
        }

        $utilisateur = new User;
        $selectId = $utilisateur->selectId($id);

        if ($selectId) {
            return View::render("client/edit", ['utilisateur' => $selectId, 'privilege_id' => $_SESSION['privilege_id']]);
        }else{
            return view::render('error');
        }
    }

}