<?php
namespace App\Models;
use App\Models\CRUD;

class Auction extends CRUD {
    protected $table = "auction";
    // idAuction, name, description, dateStart, dateEnd, startPrize, lordStar, timbre_idTimbre
    protected $primaryKey = "idAuction";
    protected $fillable = ['name', 'description', 'dateStart', 'dateEnd', 'startPrize']; 
}

?>