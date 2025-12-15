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

    public function save($data){
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