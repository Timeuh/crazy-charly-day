<?php

namespace custumbox\classes\data;

class Produit  extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'produit';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
