<?php

namespace custumbox\classes\afficheur;

class AProposAffichage extends Action {

    public function execute(): string {
        return "
        <h1>La section à propos</h1>
        ";
    }
}
