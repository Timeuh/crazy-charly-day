<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Panier;

class AffcheurPanier
{
    public function execute() : string {
        $res = "";
        $panier = Panier::all();
        $totalprix = 0;
        $totalpoid = 0;
        foreach ($panier as $item) {
            $produit = $item->produit;
            $prix = $produit->prix * $item->quantite;
            $totalprix += $prix;
            $totalpoid += $produit->poids;
            $res .= <<<HTML
                <div>
                    <img src="BD_img/{$produit->id}.jpg" alt="{$produit->nom}">
                    <h2>{$produit->nom}</h2>
                    <p>{$prix}€</p>
                    <a href="index.php?action=produit&id={$produit->id}">Voir le produit</a>
                </div>
            HTML;
        }
        $res .= <<<HTML
            <div>
                <p>Total : {$totalprix}€</p>
                <p>Poids total : {$totalpoid}g</p>
            </div>
        HTML;
        return $res;
    }
}
