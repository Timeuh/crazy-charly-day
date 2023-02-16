<?php

namespace custumbox\classes\afficheur;


use custumbox\classes\data\User;

class Deconnexion extends Action
{

    public function __construct()
    {
        parent::__construct();
    }
    public function execute() : string {
            $res = "Vous etes deconnecté";
            session_destroy();
            header("location: ./");
        return $res;
    }
}
