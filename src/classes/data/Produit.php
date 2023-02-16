<?php

namespace custumbox\classes\data;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produit extends Model {
    protected $table = 'produit';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function categorie() {
        return $this->belongsTo('custumbox\classes\data\Categorie', 'categorie');
    }

    public function users() : BelongsToMany {
        return $this->belongsToMany(
            'custumbox\classes\data\User',
            'panier',
            'idproduit',
            'idclient'
        )->withPivot('quantite')
            ->as('panier');
    }
}
