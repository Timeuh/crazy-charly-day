<?php

namespace custumbox\classes\dispatcher;

use custumbox\classes\afficheur\AccueilAffichage;
use custumbox\classes\afficheur\AffcheurPanier;
use custumbox\classes\afficheur\CatalogueAffichage;
use custumbox\classes\afficheur\Connexion;
use custumbox\classes\afficheur\Inscription;
use custumbox\classes\afficheur\ProduitAffichage;
use custumbox\classes\afficheur\Profil;

class Dispatcher
{
    private string $action;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function run() : void {
        $res = "";
        switch ($this->action) {
            case "catalogue":
                $act = new CatalogueAffichage();
                break;
            case "produit":
                $act = new ProduitAffichage();
                break;
            case "panier":
                $act = new AffcheurPanier();
                break;
            case "connexion":
                if (isset($_SESSION['user'])&&$_SESSION['user']!=null){
                    $act = new Profil();
                }else{
                    $act = new Connexion();
                }
                break;

            case "inscription":
                $act = new Inscription();
                break;

            default:
                $act = new AccueilAffichage();
                break;
        }
        $res = $act->execute();
        if (isset($_SESSION['user'])&&$_SESSION['user']!=null) {
            $this->renderPage($res);
        }else{
            $this->renderPageUser($res);
        }
    }

    private function renderPageUser(string $html) : void {
        echo <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Court-Circuit</title>
    <link href="styles/output.css" rel="stylesheet">
    <link rel="icon" href="documents/court-circuit-logo-rond-jaune-vert.png">
</head>
<body>
<div>
      <nav class="drop-shadow-2xl bg-white font-bold">
        <ul>
          <div class="flex flex-row justify-between items-center h-36">
            <img class="w-36"  src="documents/court-circuit-logo-rond-jaune-vert.png" alt="logo"  />
            <h1 class="text-4xl pr-96">Court-Circuit</h1>
            <div class="flex flex-row h-full text-center">
                <button class="navbarWrapper" > <a href='./' class="navbarLink">Accueil</a></button>
                <button class="navbarWrapper" > <a href='?action=catalogue&page=1' class="navbarLink">Catalogue</a></button>
                <button class="navbarWrapper" > <a href='?action=panier' class="navbarLink">Panier</a></button>
                <button class="navbarWrapper" > <a href='?action=connexion' class="navbarLink">Connexion</a></button>
                <button class="navbarWrapper" > <a href='?action=inscription' class="navbarLink">Inscription</a></button>
                <button class="navbarWrapper" > <a href='?action=a-propos' class="navbarLink">A propos</a></button>
            </div>
          </div>
        </ul>
      </nav>
      {$html}
    </div>
</body>
</html>
HTML;

    }
    private function renderPage(string $html) : void {
        echo <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Court-Circuit</title>
    <link href="styles/output.css" rel="stylesheet">
    <link rel="icon" href="documents/court-circuit-logo-rond-jaune-vert.png">
</head>
<body>
<div>
      <nav class="drop-shadow-2xl bg-white font-bold">
        <ul>
          <div class="flex flex-row justify-between items-center h-36">
            <img class="w-36"  src="documents/court-circuit-logo-rond-jaune-vert.png" alt="logo"  />
            <h1 class="text-4xl pr-96">Court-Circuit</h1>
            <div class="flex flex-row h-full text-center">
                <button class="navbarWrapper" > <a href='./' class="navbarLink">Accueil</a></button>
                <button class="navbarWrapper" > <a href='?action=catalogue&page=1' class="navbarLink">Catalogue</a></button>
                <button class="navbarWrapper" > <a href='?action=panier' class="navbarLink">Panier</a></button>
                <button class="navbarWrapper" > <a href='?action=profil' class="navbarLink">profil</a></button>
                <button class="navbarWrapper" > <a href='?action=deconnexion' class="navbarLink">deconnexion</a></button>
                <button class="navbarWrapper" > <a href='?action=sign-in' class="navbarLink">A propos</a></button>
            </div>
          </div>
        </ul>
      </nav>
      {$html}
    </div>
</body>
</html>
HTML;

    }



}
