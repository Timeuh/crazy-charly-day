<?php

namespace custumbox\classes\afficheur;


use custumbox\classes\data\User;

class Inscription extends Action
{

    public function __construct()
    {
        parent::__construct();
    }
    public function execute() : string {
        $res = "";
        if ($this->http_method == 'GET') {
            $res = "<div class='bg-teal-800 h-screen '>";
//S'il y a des erreurs on ajoutera une ligne supplementaire selon la nature de l'erreur renvoye
            if (isset($_GET['error'])) {
                switch ($_GET['error']) {
                    case 1:
                        $res .= "<p class='error'>Vous avez déjà un compte avec cette adresse mail ou ce login est deja pris</p><br>";
                        break;

                    case 2:
                        $res .= "<p class='error'>Votre mot de passe doit faire au moins 6 caractères avec un nombre, une minuscule et une majuscule</p><br>";
                        break;

                    case 3:
                        $res .= "<p class='error'>Votre mot de passe est different entre les 2 champs</p><br>";
                        break;
                }
            }
            $res .= "
        <form id='sign' method='post' action='?action=inscription'>
            <h1 class='text-center font-bold text-4xl pt-4 text-amber-400'>Inscription</h1>
            <div class='flex justify-center'>
                <div class='flex flex-col max-w-80 m-0 p-8  text-center w-1/4'> 
                    <span class='formSpan'>
                        <input class='formInput' type='text' name='login' placeholder=' login' required><label class='formLabel'>Login* </label>
                    </span>       
                    <span class='formSpan'>
                        <input class='formInput' type='password' name='pass' placeholder=' Mot de passe' required><label class='formLabel'>Mot de passe* </label>
                    </span>
                    <span class='formSpan'>
                        <input class='formInput' type='password' name='pass2' placeholder=' Mot de passe' required><label class='formLabel'>Répéter le mot de passe* </label>
                    </span>
                    <span class='formSpan'>
                        <input class='formInput' type='email' name='mail' placeholder=' mail' required><label class='formLabel'>Mail* </label>
                    </span>
                    <span class='formSpan'>
                        <input class='formInput' type='text' name='nom' placeholder=' nom' required><label class='formLabel'>Nom* </label>
                    </span>
                    <span class='formSpan'>
                        <input class='formInput' type='text' name='prenom' placeholder=' prenom' required><label class='formLabel'>Prenom* </label>
                    </span>
                    <span class='formSpan'>
                        <input class='formInput' type='text' name='telephone' placeholder=' telephone' required><label class='formLabel'>Telephone* </label>
                    </span>
                    <input class='userFormSubmit' type='submit' id='inscr' value='INSCRIPTION'>
                </div>
                </div>
                </div>";

            $res .= "</form>";
        }else
            if ($this->http_method == 'POST') {
                $this->inscrit();
            }
        return $res;
    }


    private function checkPasswordStrength(string $pass, int $minimumLength): bool
    {

        $length = (strlen($pass) < $minimumLength); // longueur minimale
        $digit = preg_match("#[\d]#", $pass); // au moins un digit
        $lower = preg_match("#[a-z]#", $pass); // au moins une minuscule
        $upper = preg_match("#[A-Z]#", $pass); // au moins une majuscule
        if ($length || !$digit || !$lower || !$upper) return false;
        return true;

    }

    private function inscrit():bool{
        $res = false;

        $login = $_POST['login'];
        $mdp = $_POST['pass'];
        $mdpVerif = $_POST['pass2'];
        $nom = null;
        $prenom = null;
        $mail = null;
        $telephone = null;

        if (isset($_POST['nom'])) {
            $nom = $_POST['nom'];
        }
        if (isset($_POST['prenom'])) {
            $prenom = $_POST['prenom'];
        }
        if (isset($_POST['mail'])) {
            $mail = $_POST['mail'];
        }
        if (isset($_POST['telephone'])) {
            $telephone = $_POST['telephone'];
        }

        if (!$this->checkPasswordStrength($mdp, 6)) {
            header("location: ?action=inscription&error=2");
        }

        if ($mdp != $mdpVerif) {
            header("location: ?action=inscription&error=3");
        }

        $usr = User::where('login','like',$login)->first();

        if ($usr != null){
            header("location: ?action=inscription&error=1");
        }else{

        $usr = User::where('email','like',$mail)->first();

        if ($usr != null){
            header("location: ?action=inscription&error=1");
        }else {

            $mdp = password_hash($mdp, PASSWORD_DEFAULT, ['cost' => 12]);

            $user = new User();
            $user->login = $login;
            $user->passwd = $mdp;
            $user->nom = $nom;
            $user->prenom = $prenom;
            $user->email = $mail;
            $user->telephone = $telephone;
            $user->role = 0;
            $user->save();

            $res = true;
        }
        }


        return $res;


    }


}
