<?php
namespace App\Controllers;
use App\Providers\View;
use App\Providers\Validator;

use App\Models\Stamp;

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
        $stampModel = new Stamp;
        $stamps = $stampModel->selectBy('user_idUser', $_SESSION['user_id']);

        return View::render("stamp/index", [
            'privilege_id' => $_SESSION['privilege_id'],
            'stamps'       => $stamps
        ]);
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

    public function save($data){
        $stamp = new Stamp;
        $validator = new Validator;

        $validator->field('name', $data['name'])->required()->min(5)->max(200);
        $validator->field('dateCreated', $data['dateCreated'])->required();
        $validator->field('dimension', $data['dimension'])->required()->max(45);
        $validator->field('draw', $data['draw'])->max(60);
        $validator->field('condition_idCondition', $data['condition_idCondition'])->required()->int();
        $validator->field('contry_idContry', $data['contry_idContry'])->required()->int();
        $validator->field('color_idColor', $data['color_idColor'])->required()->int();

        if($validator->isSuccess()){
            $insert = $stamp->insert($data);
            if($insert){
                return view::redirect('stamp');
            }else{
                return view::render('error');
            }
        }else{
            $colorMod = new Color;
            $condMod = new Condition;
            $contryMod = new Contry;
            $colors = $colorMod->select();
            $conditions = $condMod->select();
            $contries = $contryMod->select();

            $errors = $validator->getErrors();
            return view::render('stamp/create', [
                'errors'=> $errors, 
                'stamp' => $data,
                'privilege_id' => $_SESSION['privilege_id'],
                'user_idUser' => $_SESSION['user_id'],
                'colors' => $colors,
                'conditions' => $conditions,
                'contries' => $contries
            ]);
        }   
    }

    public function show($data){
        $id = array_key_first($data);

        $stampModel = new Stamp();
        $stamp = $stampModel->selectId($id);

        var_dump($stamp);
    }

}