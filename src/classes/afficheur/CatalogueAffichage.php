<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Produit;

class CatalogueAffichage
{
    public function execute() : string {
        $nb_produits_par_pages = 5;
        $nb_produits = 0;
        $res = "<div>";
        $produits = Produit::get();
        foreach ($produits as $produit) {
            $nb_produits++;

            $res .= <<< EOT
            <div>
                <p> Produit numéro {$nb_produits}</p>
                <img src="../../www/BD_img/{$produit->id}.jpg" alt="{$produit->nom}">
                <h2>{$produit->nom}</h2>
                <p>{$produit->description}</p>
                <p>{$produit->prix}€</p>
                <a href="index.php?action=produit&id={$produit->id}">Voir le produit</a>
                <br/>
                <br/>
                <br/>
            </div>
            EOT;
        }

        $res .= "</div>";
        $nb_pages = ceil($nb_produits / $nb_produits_par_pages);
        for ($i = 1; $i <= $nb_pages; $i++) {
            $res .= '<a href="?action=catalogue&page=' . $i . '">' . $i . '</a> ';
        }

        return $res;
    }
}
