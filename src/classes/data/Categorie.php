<?php
namespace custumbox\classes\data;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
