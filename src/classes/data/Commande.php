<?php

namespace custumbox\classes\data;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Commande extends Model
{
    protected $table = 'commande';
    protected $primaryKey = 'numComm';
    public $timestamps = false;

    public function contient() : BelongsToMany {
        return $this->belongsToMany(
            'custumbox\classes\data\Produit',
            'contient',
            'numComm',
            'idproduit'
        )->withPivot('quantite')
            ->as('contient');
    }

    public function factures() : BelongsToMany {
        return $this->belongsToMany(
            'custumbox\classes\data\User',
            'facturation',
            'numComm',
            'idclient'
        )->withPivot('dateRetrait')
            ->as('facturation');
    }
}
