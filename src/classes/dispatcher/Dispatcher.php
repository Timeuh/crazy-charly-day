<?php

namespace custumbox\classes\dispatcher;

use custumbox\classes\afficheur\AccueilAffichage;
use custumbox\classes\afficheur\AffcheurPanier;
use custumbox\classes\afficheur\CatalogueAffichage;

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
            case "panier":
                $act = new AffcheurPanier();
                break;
            default:
                $act = new AccueilAffichage();
                break;
        }
        $res = $act->execute();
        $this->renderPage($res);
    }

    private function renderPage(string $html) : void {
        echo <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Crazy Charly Day</title>
    <link href="styles/output.css" rel="stylesheet">
</head>
<body>
<div>
      <nav class="drop-shadow-2xl text-slate-400 bg-black">
        <ul>
          <div class="flex flex-row justify-between">
            <img class="w-36"  src="documents/court-circuit-logo-rond-jaune-vert.png" alt="logo"  />
            <div class="flex flex-row ">
            
            <button class="indexNavBtn" > <a href='./'><li>Accueil</li></a> </button>
            <button class="indexNavBtn" > <a href='?action=catalogue&page=1'><li>Catalogue</li></a> </button>
            <button class="indexNavBtn" > <a href='?action=sign-in'><li>Page2</li></a> </button>
            <button class="indexNavBtn" > <a href='?action=panier'><li>Panier</li></a> </button>
            <button class="indexNavBtn" > <a href='?action=sign-in'><li>A Propos</li></a> </button>
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
