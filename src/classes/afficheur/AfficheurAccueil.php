<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Produit;

class AfficheurAccueil
{
    public function execute() : string {
        $res = "";

        $res .= "<div>";
        $produits = Produit::get();
        foreach ($produits as $produit) {
            $res .= <<< EOT
            <div>
                <img src="../../www/BD_img/{$produit->id}.jpg" alt="{$produit->nom}">
                <h2>{$produit->nom}</h2>
                <p>{$produit->description}</p>
                <p>{$produit->prix}€</p>
                <a href="index.php?action=produit&id={$produit->id}">Voir le produit</a>
            </div>
            EOT;
        }

        return $res;
    }
}
