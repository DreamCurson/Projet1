<?php
namespace App\Models;
use App\Models\CRUD;

class Bid extends CRUD {
    protected $table = "bid";
    protected $primaryKey = "idBid";
    // idBid, date, bid, user_idUser, auction_idAuction
    protected $fillable = ['date', 'bid', 'user_idUser', 'auction_idAuction']; 

    final function getLastBidByAuction(int $auctionId): ?array{
        $sql = "SELECT * FROM bid WHERE auction_idAuction = :id ORDER BY date DESC LIMIT 1";

        $stmt = $this->prepare($sql);
        $stmt->execute(['id' => $auctionId]);
        return $stmt->fetch() ?: null;

        return $stmt ? $stmt->fetch() : null;
    }
}

?>
