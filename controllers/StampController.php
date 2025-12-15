<?php
namespace App\Controllers;
use App\Providers\View;
use App\Providers\Validator;

use App\Models\Stamp;
use App\Models\Image;
use App\Models\Auction;

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
        $stampModel = new Stamp();
        $stamps = $stampModel->selectBy('user_idUser', $_SESSION['user_id']);

        $imageModel = new Image();
        $auctionModel = new Auction();

        foreach ($stamps as &$stamp) {
            $images = $imageModel->selectBy('timbre_idTimbre', $stamp['idTimbre']);
            foreach ($images as &$img) {
                $img['file'] = base64_encode($img['file']); // ENCODE
            }
            unset($img);

            $stamp['images'] = $images;

            // Valide qu'une enchère existe sur le timbre
            $auction = $auctionModel->selectBy('timbre_idTimbre', $stamp['idTimbre']);

            // Si l'enchère existe
            if (!empty($auction)) {
                $currentDate = date('Y-m-d H:i:s');
                $auction = $auction[0];

                // Ajoute l'id de l'enchère dans les données du timbre
                $stamp['auction_id'] = $auction['idAuction'];

                // Si l'enchère est active
                if ($currentDate >= $auction['dateStart'] && $currentDate <= $auction['dateEnd']) {
                    $stamp['has_active_auction'] = true;
                    $stamp['auction_status'] = 'active';
                }
                // Si l'enchère n'est pas commencé encore
                elseif ($currentDate < $auction['dateStart']) {
                    $stamp['has_active_auction'] = true;
                    $stamp['auction_status'] = 'upcoming';
                    $stamp['auction_start_date'] = $auction['dateStart'];
                }
                // Si l'enchère est terminé
                elseif ($currentDate > $auction['dateEnd']) {
                    $stamp['has_active_auction'] = true;
                    $stamp['auction_status'] = 'ended';
                    $stamp['auction_end_date'] = $auction['dateEnd'];
                }
            } else {
                $stamp['has_active_auction'] = false;
            }
        }
        unset($stamp);

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

   public function show($data) {
        $id = array_key_first($data);        
        if (!$id) {
            return View::redirect("login");
        }

        $stampModel = new Stamp();
        $stamp = $stampModel->selectId($id);

        if ($stamp['user_idUser'] != $_SESSION['user_id']) {
            return View::redirect("login");
        }

        $imageModel = new Image();
        $images = $imageModel->selectBy('timbre_idTimbre', $stamp['idTimbre']);

        // Encode
        foreach ($images as &$img) {
            $img['file'] = base64_encode($img['file']);
        }
        unset($img);
        $stamp['images'] = $images;

        $colorMod = new Color;
        $condMod = new Condition;
        $contryMod = new Contry;
        $colors = $colorMod->select();
        $conditions = $condMod->select();
        $contries = $contryMod->select();

        return view::render('stamp/show', [
            'stamp' => $stamp,
            'privilege_id' => $_SESSION['privilege_id'],
            'colors' => $colors,
            'conditions' => $conditions,
            'contries' => $contries
        ]);
    }

    public function edit($data){
        $id = array_key_first($data);        
        if (!$id) {
            return View::redirect("login");
        }

        $stampModel = new Stamp();
        $stamp = $stampModel->selectId($id);

        if ($stamp['user_idUser'] != $_SESSION['user_id']) {
            return View::redirect("login");
        }

        $colorMod = new Color;
        $condMod = new Condition;
        $contryMod = new Contry;
        $colors = $colorMod->select();
        $conditions = $condMod->select();
        $contries = $contryMod->select();

        return view::render('stamp/edit', [
            'idTimbre' => $id,
            'stamp' => $stamp,
            'privilege_id' => $_SESSION['privilege_id'],
            'colors' => $colors,
            'conditions' => $conditions,
            'contries' => $contries
        ]);
    }

    public function update($data){
        $stamp = new Stamp;
        $validator = new Validator;

        $validator->field('name', $data['name'])->required()->min(5)->max(200);
        $validator->field('dateCreated', $data['dateCreated'])->required();
        $validator->field('dimension', $data['dimension'])->required()->max(45);
        $validator->field('draw', $data['draw'])->max(200);
        $validator->field('condition_idCondition', $data['condition_idCondition'])->required()->int();
        $validator->field('contry_idContry', $data['contry_idContry'])->required()->int();
        $validator->field('color_idColor', $data['color_idColor'])->required()->int();

        if($validator->isSuccess()){
            $update = $stamp->update($data, $data['idTimbre']);
            if($update){
                return view::redirect("stampShow?{$data['idTimbre']}");
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
            return view::render('stamp/edit', [
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

    public function delete($data){
        $id = array_key_first($data);        
        if (!$id) {
            return View::redirect("login");
        }

        $stampModel = new Stamp();
        
        $delete = $stampModel->delete($id);
        if($delete){
            return view::redirect("stamp");
        }else{
            return view::render('error');
        }
    }

}