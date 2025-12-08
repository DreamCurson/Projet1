<?php
namespace App\Models;
use App\Models\CRUD;

class Condition extends CRUD {
    protected $table = "conditions";
    protected $primaryKey = "idCondition";
    protected $fillable = ['cond']; 
}

?>