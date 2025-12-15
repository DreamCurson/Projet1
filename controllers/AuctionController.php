<?php
namespace App\Controllers;
use App\Providers\View;
use App\Providers\Validator;

use App\Models\Auction;


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
        
        return view::render('auction/create', ['id' => $id]);

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
                echo "réussi";
            }else{

            }
        }else{
            $errors = $validator->getErrors();
            return View::render('auction/create', ['errors'=>$errors, 'auction'=>$data]);
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