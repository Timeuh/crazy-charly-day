<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Produit;

class Profil
{
    public function execute() : string {
        $res = "<p>Bienvenue sur notre site</p>";
        return $res;
    }
}
