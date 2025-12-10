<?php
namespace App\Controllers;
use App\Providers\View;
use App\Providers\Validator;

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

    public function store($data) {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $errors['message'] = 'Votre image n\'est pas valide';
            return view::render('image/index', [
                'errors' => $errors,
                'idStamp' => $data['timbre_idTimbre'],
                'privilege_id' => $_SESSION['privilege_id'],
                'user_idUser' => $_SESSION['user_id'],
            ]);
        }

        $validator = new Validator();
        $validator->field('description', $data['description'])->required()->min(5)->max(60);
        $validator->field('file', $_FILES['file'])->required();
        $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];

        if ($validator->isSuccess() && in_array($_FILES['file']['type'], $allowedTypes)) {
            $fileContent = file_get_contents($_FILES['file']['tmp_name']);
            $description = $data['description'];
            $order = $data['order'] ?? 1;
            $timbre_idTimbre = $data['timbre_idTimbre'];

            $image = new Image();
            $inserted = $image->insert([
                'file' => $fileContent,
                'description' => $description,
                'imageOrder' => $order,
                'timbre_idTimbre' => $timbre_idTimbre
            ]);

            if ($inserted) {
                return View::redirect("stamp");
            } else {
                die("Erreur lors de l'insertion de l'image en base de données");
            }
        } else {
            $errors = $validator->getErrors();
            if (!in_array($_FILES['file']['type'], $allowedTypes)) {
                $errors['message'] = 'Votre image doit être un PNG, JPG ou JPEG';
            }
            return view::render('image/index', [
                'errors' => $errors,
                'idStamp' => $data['timbre_idTimbre'],
                'privilege_id' => $_SESSION['privilege_id'],
                'user_idUser' => $_SESSION['user_id'],
            ]);
        } 
    }

}