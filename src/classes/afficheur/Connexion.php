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
       <div class='bg-teal-800 h-screen'>";
            //S'il y a des erreurs on ajoutera une ligne supplementaire selon la nature de l'erreur renvoye
            if (isset($_GET['error'])) {
                $res .= "<h1 class='error'>Login ou mot de passe faux</h1>";
            }

            $res .= "
           <form id='sign' method='post' action='?action=connexion'>
                <h1 class='text-center font-bold text-4xl pt-4 text-amber-400'>Connexion</h1>
                <div class='flex justify-center'>
                    <div class='flex flex-col max-w-80 m-0 p-8 text-center w-1/4'>
                        <span class='formSpan'>
                            <input class='formInput' type='text' name='login' placeholder=' login' required><label class='formLabel'>Login* </label>
                        </span>
                        <span class='formSpan'>
                            <input class='formInput' type='password' name='pass' placeholder='Mot de passe' required><label class='formLabel'>Login* </label>
                        </span>
                        <input class='userFormSubmit' type='submit' id='inscr' value='Connexion'>
                    </div>
                </div>
           </form>
       </div>
       ";
        }else
            if ($this->http_method == 'POST') {
                $login = $_POST['login'];
                $mdp = $_POST['pass'];

                $mdp = password_hash($mdp, PASSWORD_DEFAULT, ['cost' => 12]);


                $user = User::where('login','like',$login)->first();
                if ($user != null){
                    echo "<script>alert('Connexion réussie')</script>";
                    $_SESSION['user'] = serialize($user);
                    $res = true;
                }else{
                    header("location: ?action=connexion&error=1&ps=$mdp");
                }
            }
        return $res;
    }
}
