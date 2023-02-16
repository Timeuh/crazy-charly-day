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

        if ($this->http_method == 'GET') {
            $res = "
        <form id='sign' method='post' action='?action=inscription'>
                    <h1>Inscription</h1>
                    <label><b>login*</b><input type='text' name='login' placeholder='login' required></label>
                    <label><b>Mot de passe*</b> <input type='password' name='pass' placeholder='Mot de passe' required></label>
                    <label><b>Entrer à nouveau votre mot de passe*</b> <input type='password' name='pass2' placeholder='Entrer à nouveau votre mot de passe' required></label>
                    <label><b>mail</b><input type='email' name='mail' placeholder='mail' required></label>
                    <label><b>nom</b><input type='text' name='nom' placeholder='nom'></label>
                    <label><b>prenom</b><input type='text' name='prenom' placeholder='prenom'></label>
                    <label><b>telephone</b><input type='number' name='telephone' placeholder='telephone'></label>
                    <input type='submit' id='inscr' value='INSCRIPTION'>";
            //S'il y a des erreurs on ajoutera une ligne supplementaire selon la nature de l'erreur renvoye
            if (isset($_GET['error'])) {
                switch ($_GET['error']) {
                    case 1:
                        $res .= "<p style='color:red'>Vous avez déjà un compte avec cette adresse mail</p><br>";
                        break;

                    case 2:
                        $res .= "<p style='color:red'>Votre mot de passe doit faire au moins 6 caractères avec un nombre, une minuscule et une majuscule</p><br>";
                        break;

                    case 3:
                        $res .= "<p style='color:red'>Votre mot de passe est different entre les 2 champs</p><br>";
                        break;
                }
            }
            $res .= "</form>";
        }else
            if ($this->http_method == 'POST') {
                $bool = $this->inscrit();
                if ($bool){
                    $res = "<p>Vous êtes inscrit</p>";
                }else{
                    header('location: ?action=inscription');
                }
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

    public function inscrit():bool{
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

        if ($mdp != $mdpVerif) {
            header("location: ?action=inscription&error=3");
        }


        if (count(User::where('email','like',$mail->get()))==0){
            header("location: ?action=inscription&error=1");
        }


        $mdp = password_hash($mdp, PASSWORD_DEFAULT, ['cost' => 12]);

        $user = new User();
        $user->login = $login;
        $user->mdp = $mdp;
        $user->email = $mail;
        $user->nom = $nom;
        $user->prenom = $prenom;
        $user->telephone = $telephone;
        $user->role = 0;
        $user->save();


        $res = true;


        return $res;


    }


}
