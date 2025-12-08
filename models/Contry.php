<?php
namespace App\Models;
use App\Models\CRUD;

class Contry extends CRUD {
    protected $table = "contry";
    protected $primaryKey = "idContry";
    protected $fillable = ['contry']; 
}

?>