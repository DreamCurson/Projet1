<?php
namespace App\Controllers;
use App\Providers\View;
use App\Models\User;
use App\Providers\Validator;

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

    public function update($data = []){
        if(isset($data['idUser']) && $data['idUser'] != null){
            $validator = new Validator;
            $utilisateur = new User;

            $validator->field('name', $data['name'])->required()->min(2)->max(60);

            // Si le mot de passe n'est pas vide on valide qu'il respecte les conditions min max
            if(!empty($data['password'])) {
                $validator->field('password', $data['password'])->min(6)->max(30);
            }

            // On prend l'email dans la session et celui dans la data
            $currentEmail = $_SESSION['user_email'];
            $dataEmail = $data['email'];
            // Si l'email dans data n'est pas similaire à celui dans la session on valide le unique
            if ($dataEmail !== $currentEmail) {
                $validator->field('email', $dataEmail)->unique('User')->required()->email()->min(2)->max(150);
            } else {
                // Si l'email est le même que celui dans la session on ne valide pas le unique
                $validator->field('email', $dataEmail)->required()->email()->min(2)->max(150);
            }

            if($validator->isSuccess()){
                $utilisateur = new User;
                if(empty($data['password'])) {
                    unset($data['password']);
                } else {
                    $data['password'] = $utilisateur->hashPassword($data['password']);
                }

                $update = $utilisateur->update($data, $data['idUser']);
                if($update){
                    $_SESSION['user_email'] = $data['email'];
                    $_SESSION['user_name'] = $data['name'];
                    return View::redirect('profil');
                } else {
                    return View::render('error', ['msg'=>'Modification impossible pour le moment']);
                }
            } else {
                $errors = $validator->getErrors();
                return View::render('client/edit', ['errors'=>$errors, 'utilisateur'=>$data]);
            }
        }else{
            return View::redirect('login');
        }
    }

    public function delete($id = null){
        if ($id === null && isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }else{
            return View::render('login');
        }

        $utilisateur = new User;
        $delete = $utilisateur->delete($id);

        if($delete){
            return View::redirect('login');
        }else{
            return View::render('error', ['msg'=>'Impossible de supprimer votre compte !']);
        }
    }

}