<?php

namespace custumbox\classes\afficheur;


class Connexion extends Action
{

    public function __construct()
    {
        parent::__construct();
    }
    public function execute() : string {
        $res = "
        <form id='sign' method='post' action='?action=add-user'>
                    <h1>Inscription</h1>
                    <label><b>login</b><input type='text' name='login' placeholder='login' required></label>
                    <label><b>Mot de passe</b> <input type='password' name='pass' placeholder='Mot de passe' required></label>
                    <input type='submit' id='log' value='Connexion'>";
        //S'il y a des erreurs on ajoutera une ligne supplementaire selon la nature de l'erreur renvoye
        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 1:
                    $res .= "<p style='color:red'>Vous avez déjà un compte avec cette adresse mail</p><br>";
                    break;

                case 2:
                    $res .= "<p style='color:red'>Votre mot de passe doit faire au moins 5 caractères avec un nombre, une minuscule et une majuscule</p><br>";
                    break;

                case 3:
                    $res .= "<p style='color:red'>Votre mot de passe est different entre les 2 champs</p><br>";
                    break;
            }
        }
        $res .= "</form>";
        return $res;
    }
}
