<?php

namespace custumbox\classes\data;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Panier extends Model
{
    protected $table = 'panier';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function produit() : BelongsTo {
        return $this->belongsTo('custumbox\classes\data\Produit', 'idproduit');
    }
}
