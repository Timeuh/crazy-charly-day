<?php

namespace custumbox\classes\afficheur;


use custumbox\classes\data\User;

class Connexion extends Action
{

    public function __construct()
    {
        parent::__construct();
    }
    public function execute() : string {

        if ($this->http_method == 'GET') {
            $res = "
        <form id='sign' method='post' action='?action=connexion'>
                    <h1>Inscription</h1>
                    <label><b>login*</b><input type='text' name='login' placeholder='login' required></label>
                    <label><b>Mot de passe*</b> <input type='password' name='pass' placeholder='Mot de passe' required></label>
                    <input type='submit' id='inscr' value='INSCRIPTION'>";
            //S'il y a des erreurs on ajoutera une ligne supplementaire selon la nature de l'erreur renvoye
            if (isset($_GET['error'])) {
                        $res .= "<p style='color:red'>Login ou mot de passe faux</p><br>";
            }
            $res .= "</form>";
        }else
            if ($this->http_method == 'POST') {
                $bool = $this->connexion();
                if ($bool){
                    header('location: ./');
                }
            }
        return $res;
    }

    public function connexion():bool{
        $res = false;

        $login = $_POST['login'];
        $mdp = $_POST['pass'];

        $mdp = password_hash($mdp, PASSWORD_DEFAULT, ['cost' => 12]);


        $user = User::where('login','like',$login)->where('passwd','like',$mdp)->first();
        var_dump($user);
        if ($user!=null){
            $res = true;
        }else{
            header("location: ?action=connexion&error=1");
        }

        return $res;
    }


}
