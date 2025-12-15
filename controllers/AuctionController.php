<?php
namespace App\Controllers;
use App\Providers\View;
use App\Providers\Validator;

use App\Models\Auction;
use App\Models\Stamp;
use App\Models\Image;


class AuctionController{
    public function __construct() {
        session_start();
        if (!isset($_SESSION['privilege_id'])) {
            return View::redirect("login");
        }
    }

    public function index() {
        $auctionModel = new Auction();
        $auctions = $auctionModel->select(); 
        
        $imageModel = new Image();

        $currentDate = date('Y-m-d');

        // Traiter chaque enchère
        foreach ($auctions as &$auction) {
            // Vérifier si l'enchère a commencé, est active, ou est terminée
            if ($currentDate >= $auction['dateStart'] && $currentDate <= $auction['dateEnd']) {
                $auction['status'] = 'active';
            } elseif ($currentDate < $auction['dateStart']) {
                $auction['status'] = 'upcoming';
                $auction['start_date'] = $auction['dateStart'];
            } else {
                $auction['status'] = 'ended';
                $auction['end_date'] = $auction['dateEnd'];
            }

            // Récupérer les images associées à cette enchère
            $images = $imageModel->selectBy('timbre_idTimbre', $auction['timbre_idTimbre']);

            // encoder image en base64
            foreach ($images as &$img) {
                $img['file'] = base64_encode($img['file']);
            }
            unset($img);

            // Assigne image à l'enchère
            $auction['images'] = $images;
        }

        return View::render('auction/index', [
            'privilege_id' => $_SESSION['privilege_id'],
            'auctions' => $auctions
        ]);
    }


    public function create($data){
        if ($_SESSION['privilege_id'] != 1) {
            return View::redirect("login");
        }
        $id = array_key_first($data);        
        if (!$id) {
            return View::redirect("login");
        }

        $stamp = new Stamp();
        $stampData = $stamp->selectId($id);
        
        return view::render('auction/create', ['id' => $id, 'privilege_id' => $_SESSION['privilege_id'], 'timbreName' => $stampData['name']]);

    }

    public function store($data){
        if ($_SESSION['privilege_id'] != 1) {
            return View::redirect("login");
        }
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
        if ($_SESSION['privilege_id'] != 1) {
            return View::redirect("login");
        }

        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            return View::redirect("login");
        }

        $auctionModel = new Auction();
        $auction = $auctionModel->selectId($id);

        if ($auction) {
            $currentDate = date('Y-m-d H:i:s');

            if ($currentDate > $auction['dateEnd']) {
                $auction['status'] = 'ended';
                $auction['end_date'] = $auction['dateEnd'];
            } elseif ($currentDate < $auction['dateStart']) {
                $auction['status'] = 'upcoming';
                $auction['start_date'] = $auction['dateStart'];
            } else {
                $auction['status'] = 'active';
            }
        } else {
            return View::redirect("error");
        }

        return View::render('auction/show', [
            'auction' => $auction
        ]);
    }




    public function edit($data){
    }

    public function update($data){
    }

    public function delete($data){
        if ($_SESSION['privilege_id'] != 1) {
            return View::redirect("login");
        }
        $id = array_key_first($data);        
        if (!$id) {
            return View::redirect("login");
        }

        $auctionModel = new Auction();
        
        $delete = $auctionModel->delete($id);
        if($delete){
            return view::redirect("stamp");
        }else{
            return view::render('error');
        }
    }

}