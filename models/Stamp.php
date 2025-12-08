<?php
namespace App\Models;
use App\Models\CRUD;

class Stamp extends CRUD {
    protected $table = "timbre";
    protected $primaryKey = "idTimbre";
    protected $fillable = [
        'name',
        'dateCreated',
        'condition_idCondition',
        'contry_idContry',
        'dimension',
        'draw',
        'user_idUser',
        'color_idColor'
    ];
}

?>