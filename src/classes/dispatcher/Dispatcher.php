<?php

namespace custumbox\classes\dispatcher;

use custumbox\classes\afficheur\AfficheurAccueil;

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
            default:
                $act = new AfficheurAccueil();
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
              <button class="indexNavBtn"> <li>Accueil</li> </button>
              <button class="indexNavBtn"> <li>page1</li> </button>
              <button class="indexNavBtn"> <li>page2</li> </button>
              <button class="indexNavBtn"> <li>page3</li> </button>
              <button class="indexNavBtn"> <li>a propos de nous</li> </button>
            </div>
          </div>
        </ul>
      </nav>
      <h1>Notre Site</h1>
      {$html}
    </div>
</body>
</html>
HTML;

    }

}
