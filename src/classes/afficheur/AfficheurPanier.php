<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Panier;

class AfficheurPanier
{
    public function execute() : string {
        if (!isset($_SESSION['user']))
            return "<div class='bg-teal-800 h-[49.2rem]'>
                        <h1 class='text-center text-yellow-500 py-8 font-bold'>Vous devez être connecté pour accéder à votre panier</h1>
                    </div>
                    ";

        // Session exist
        $res = "";
        $panier = unserialize($_SESSION['user'])->produits;
        $totalprix = 0;
        $totalpoid = 0;
        foreach ($panier as $produit) {
            $prix = $produit->prix * $produit->panier->quantite;
            $totalprix += $prix;
            $totalpoid += $produit->poids * $produit->panier->quantite;
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
                <a href="index.php?action=commande">Valider la commande</a> 
            </div>
        HTML;
        return $res;
    }
}
