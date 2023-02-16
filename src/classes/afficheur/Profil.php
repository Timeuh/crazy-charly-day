<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Produit;

class Profil
{
    public function execute() : string {
        $res = "";
        $user = unserialize($_SESSION['user']);
        if ($user==null){
            $res = "vous devez etre connecter";
        }else{
         $res =  $user->nom." ".$user->prenom;
        }
        return $res;
    }
}
