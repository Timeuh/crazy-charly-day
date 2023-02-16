<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Produit;

class AfficheurAccueil
{
    public function execute() : string {
        $res = "";
        $res = <<< EOT
        <nav>
            <img src="../../../www/documents/court-circuit-logo-rond-jaune-vert.pn" alt="logo">
            <a href="index.php?action=accueil">Accueil</a>
            <a href="index.php?action=produits">Produits</a>
            <a href="index.php?action=categories">Catégories</a>
            <a href="index.php?action=panier">Panier</a>
            <a href="index.php?action=connexion">Connexion</a>
        </nav>
        EOT;

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
