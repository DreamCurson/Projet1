<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\User;
use App\Providers\Validator;

class AuthController{

    // Retourne à la page de connexion
    public function index(){
        session_start();
        session_destroy();
        return View::render("auth/index");
    }

    public function guest(){
        session_start();
        $_SESSION['privilege_id'] = 2;
        return View::redirect('lordStampee');
    }

    // Retourne à la page d'inscription
    public function inscription(){
        return View::render("auth/create");
    }

    // Valide si tout les champs sont respecter
    // Si oui store les données avec le User Model
    // Si non retourne à la page d'inscription avec les erreurs
    public function create($data){
        $utilisateur = new User;
        $validator = new Validator;

        $validator->field('name', $data['name'])->required()->min(2)->max(60);
        $validator->field('email', $data['email'])->unique('User')->required()->email()->min(2)->max(150);
        $validator->field('password', $data['password'])->required()->min(6)->max(30);

        if($validator->isSuccess()){
            $data['password'] = $utilisateur->hashPassword($data['password']);
            // 1 = member
            $data['permision_idPermission'] = 1;
            $insert = $utilisateur->insert($data);
            if($insert){
                return view::redirect('login');
            }else{
                return view::render('error');
            }
        }else{
            $errors = $validator->getErrors();
            return view::render('auth/create', ['errors'=>$errors, 'utilisateur' =>$data]);
        }
    }

    // Valide les informations de connexion
    // Si valide crée la session et redirige à la page principal
    // Si invalide retourne au formulaire de connexion avec les erreurs
    public function validate($data){
        $validator = new Validator;
        $validator->field('email', $data['email'])->required()->email()->min(2)->max(150);
        $validator->field('password', $data['password'])->required()->min(6)->max(30);
        if($validator->isSuccess()){
            $utilisateur = new User();
            $checkuser = $utilisateur->checkUser($data['email'], $data['password']);
            if($checkuser){
                return View::redirect('lordStampee');
            }else{
                $errors['message'] = 'Information de connexion invalide';
                return View::render('auth/index', ['errors'=>$errors, 'utilisateur'=>$data]);
            }
        }else{
            $errors = $validator->getErrors();
            return View::render('auth/index', ['errors'=>$errors, 'utilisateur'=>$data]);
        }
    }

    public function logout(){
        
    }

}

?>