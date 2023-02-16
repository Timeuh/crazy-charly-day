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
        echo <<< EOT
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>CrazyCharlyDay</title>
            <link rel="stylesheet" href="src/Styles/CSS/tailwind.css"/>
        </head>
        <body>
            $html
        </body>
        </html>
        EOT;

    }

}
