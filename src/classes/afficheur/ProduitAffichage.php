<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Panier;
use custumbox\classes\data\Produit;
use custumbox\classes\data\User;

class ProduitAffichage
{
    public function execute(): string
    {
        $res = "<div>";
        $produit = Produit::where([
            ['id', '=', $_GET['id']]
        ])->first();
        $idProduit = $produit->id;
        $categorie = $produit->categorie()->first();
        $res .= <<< EOT
            <div>
                <h2>{$produit->nom}</h2>
                <h3>{$categorie->nom}</h3>
                <img src="BD_img/{$produit->id}.jpg" alt="{$produit->nom}">
                <p>{$produit->description}</p>
                <p>{$produit->detail}</p>
                <p>{$produit->prix}€</p>
                <form action="index.php?action=produit&id=$idProduit" method="post">
                    <p>Quantité : <input type="number" name="quantite" id="quantite" value="1" min="1" max="99"></p>
                    <button class="buttonPanier" type="submit">Ajouter au panier</button>
                </form>
            </div>
            EOT;
        $res .= "</div>";

        if (isset($_POST['quantite']) && isset($_SESSION['user'])) {
            $pannier = $_SESSION['user']->produits();
            if ($pannier->where('idproduit', '=', $idProduit)->exists()) {
                $produit = $pannier->where('idproduit', '=', $idProduit)->first();
                $qtq = $produit->panier->quantite;
                $qtq += $_POST['quantite'];
                $pannier->updateExistingPivot($idProduit, ['quantite' => $qtq]);
            } else {
                $pannier->attach($idProduit, ['quantite' => $_POST['quantite']]);
            }
        }

        return $res;
    }
}
