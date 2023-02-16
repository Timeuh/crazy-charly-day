<?php

namespace custumbox\classes\afficheur;

class Profil
{
    public function execute() : string {
        $res = "";
        $user = unserialize($_SESSION['user']);
        if ($user==null){
            $res = "<h1 class='error'>vous devez être connecté</h1>";
        }else {
            $res = "<div class='flex flex-col h-screen text-4xl text-yellow-500 bg-emerald-700 text-center'>
                <h1><span>Nom : </span>" . $user->nom . "</h1> <h1><span>Prenom : </span>" . $user->prenom . "</h1></div>";
        }
        return $res;
    }
}
