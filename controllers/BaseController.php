<?php
namespace App\Controllers;
use App\Providers\View;
use App\Models\Auction;
use App\Models\Stamp;
use App\Models\Image;
use App\Models\User;
use App\Models\Bid;

use App\Models\Color;
use App\Models\Condition;
use App\Models\Contry;


class BaseController{
    public function __construct() {
        session_start();
        if (!isset($_SESSION['privilege_id'])) {
            return View::redirect("login");
        }
    }


    public function index(){
        return View::render("base/index", ['privilege_id' => $_SESSION['privilege_id']]);
    }

    public function detail($data){
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            return View::redirect("login");
        }

        $auctionModel = new Auction();
        $auction = $auctionModel->selectId($id);

        $stampModel = new Stamp();
        $stamp = $stampModel->selectId($auction['timbre_idTimbre']);

        $colorMod = new Color;
        $condMod = new Condition;
        $contryMod = new Contry;
        $colors = $colorMod->select();
        $conditions = $condMod->select();
        $contries = $contryMod->select();

        $imageModel = new Image();

        $images = $imageModel->selectBy('timbre_idTimbre', $auction['timbre_idTimbre']);
        foreach ($images as &$img) {
            $img['file'] = base64_encode($img['file']);
        }
        unset($img);

        $auction['images'] = $images;
        $auction['current_price'] = $auctionModel->getCurrentPrice($auction['idAuction']);

        $bidModel = new Bid();

        $lastBid = $bidModel->getLastBidByAuction($auction['idAuction']);
        $lastBidder = null;

        if (!empty($lastBid) && isset($lastBid['user_idUser'])) {
            $userModel = new User();
            $user = $userModel->selectId($lastBid['user_idUser']);
            $lastBidder = $user['name'] ?? null;
        }

        $totalBids = $bidModel->countBy('auction_idAuction', $auction['idAuction']);

        return View::render("base/detail", [
            'user_id' => $_SESSION['user_id'] ?? null,
            'privilege_id' => $_SESSION['privilege_id'],
            'auction' => $auction,
            'stamp' => $stamp,
            'colors' => $colors,
            'conditions' => $conditions,
            'contries' => $contries,
            'lastBidder' => $lastBidder,
            'totalBid' => $totalBids
        ]);
    }
}