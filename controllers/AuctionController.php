<?php
namespace App\Controllers;
use App\Providers\View;
use App\Providers\Validator;

use App\Models\Auction;
use App\Models\Stamp;


class AuctionController{
    public function __construct() {
        session_start();
        if ($_SESSION['privilege_id'] != 1) {
            return View::redirect("login");
        }
    }

    public function create($data){
        $id = array_key_first($data);        
        if (!$id) {
            return View::redirect("login");
        }

        $stamp = new Stamp();
        $stampData = $stamp->selectId($id);
        
        return view::render('auction/create', ['id' => $id, 'privilege_id' => $_SESSION['privilege_id'], 'timbreName' => $stampData['name']]);

    }

    public function store($data){
        $validator = new Validator;
        $validator->field('name', $data['name'])->required()->min(2)->max(45);
        $validator->field('description', $data['description'])->required()->min(10)->max(500);
        $validator->field('dateStart', $data['dateStart'])->required();
        $validator->field('dateEnd', $data['dateEnd'])->required()->afterDate($data['dateStart']);
        $validator->field('startPrize', $data['startPrize'])->required();

        if($validator->isSuccess()){
            $auction = new Auction();
            $insert = $auction->insert($data);

            if($insert){
                 return view::redirect("stamp");
            }else{
                return view::render('error');
            }
        }else{
            $id = $data['timbre_idTimbre'];
            $errors = $validator->getErrors();
            return View::render('auction/create', ['errors'=>$errors, 'auction'=>$data, 'privilege_id' => $_SESSION['privilege_id'], 'id' => $id]);
        }

    }

   public function show($data) {
    }

    public function edit($data){
    }

    public function update($data){
    }

    public function delete($data){
    }

}