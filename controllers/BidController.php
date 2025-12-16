<?php
namespace App\Controllers;
use App\Providers\View;
use App\Providers\Validator;

use App\Models\Bid;
use App\Models\Auction;

class BidController{
    public function __construct() {
        session_start();
        if ($_SESSION['privilege_id'] != 1) {
            return View::redirect("login");
        }
    }

    public function newBid($data) {
        // Vérifier que les données nécessaires sont présentes
        if (!isset($data['bid']) || !isset($data['user_id']) || !isset($data['auction_id'])) {
            return view::render('error', ['message' => 'Données manquantes.']);
        }

        $auctionModel = new Auction();
        $auction = $auctionModel->selectId($data['auction_id']);

        if (!$auction) {
            return view::render('error', ['message' => 'Enchère non trouvée.']);
        }

        $bidModel = new Bid();
        $currentPrice = $auctionModel->getCurrentPrice($data['auction_id']);
        $minBid = $currentPrice;

        // Vérifie si la mise est supérieure à la mise minimale
        if ($data['bid'] <= $minBid) {
            return view::render('error', ['message' => "Votre mise doit être supérieure à $minBid."]);
        }

        $bidData = [
            'date' => date('Y-m-d H:i:s'),
            'bid' => $data['bid'],
            'user_idUser' => $data['user_id'],
            'auction_idAuction' => $data['auction_id']
        ];

        $bid = $bidModel->insert($bidData);

        if ($bid) {
            return view::render('bid/success', ['auction' => $auction]);
        } else {
            return view::render('error', ['message' => 'Une erreur est survenue lors de l\'enregistrement de la mise.']);
        }
    }

}