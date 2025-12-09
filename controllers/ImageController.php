<?php
namespace App\Controllers;
use App\Providers\View;
use App\Models\Image;

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

    public function store($data){
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            die("Erreur");
        }

        $fileContent = file_get_contents($_FILES['file']['tmp_name']);

        $description = $data['description'] ?? null;
        $order = $data['order'] ?? 1;
        $timbre_idTimbre = $data['timbre_idTimbre'];

        $image = new Image();
        $image->insert([
            'file' => $fileContent,
            'description' => $description,
            'imageOrder' => $order,
            'timbre_idTimbre' => $timbre_idTimbre
        ]);

        if($image){
            return View::redirect("stamp");
        }
    }

}