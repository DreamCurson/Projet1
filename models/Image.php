<?php
namespace App\Models;
use App\Models\CRUD;

class Image extends CRUD {
    protected $table = "image";
    protected $primaryKey = "idImage";
    protected $fillable = ['file', 'description', 'order', 'timbre_idTimbre']; 
}

?>