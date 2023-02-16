<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Produit;

class AccueilAffichage
{
    public function execute() : string {
        $res = "<p>Bienvenue sur notre site</p>";
        return $res;
    }
}
