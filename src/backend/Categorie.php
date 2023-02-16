<?php
namespace custumbox\backend;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
