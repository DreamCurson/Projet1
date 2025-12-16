<?php
namespace App\Models;
use App\Models\CRUD;

class Bid extends CRUD {
    protected $table = "bid";
    protected $primaryKey = "idBid";
    // idBid, date, bid, user_idUser, auction_idAuction
    protected $fillable = ['date', 'bid', 'user_idUser', 'auction_idAuction']; 
}

?>
