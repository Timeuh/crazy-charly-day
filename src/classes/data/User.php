<?php

namespace custumbox\classes\data;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model
{
    protected $table = 'user_cc';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function produits() : BelongsToMany {
        return $this->belongsToMany(
            'custumbox\classes\data\Produit',
            'panier',
            'idclient',
            'idproduit'
        )->withPivot('quantite')
            ->as('panier');
    }
}
