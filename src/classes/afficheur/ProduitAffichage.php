<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Produit;

class ProduitAffichage
{
    public function execute() : string {
        $res = "<div>";
        $produit = Produit::where([
            ['id', '=', $_GET['id']]
        ])->first();
        $categorie = $produit->categorie()->first();
        $res .= <<< EOT
            <div>
                <h2>{$produit->nom}</h2>
                <h3>{$categorie->nom}</h3>
                <img src="BD_img/{$produit->id}.jpg" alt="{$produit->nom}">
                <p>{$produit->description}</p>
                <p>{$produit->detail}</p>
                <p>{$produit->prix}€</p>
                <form action="index.php?action=panier" method="post">
                    <p>Quantité : <input type="number" name="quantite" id="quantite" value="1" min="1" max="99"></p>
                    <button class="buttonPanier"><a href="index.php">Ajouter au panier</a></button>
                </form>
            </div>
            EOT;
        $res .= "</div>";

        return $res;
    }
}
