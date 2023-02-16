<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Produit;

class CatalogueAffichage extends Action
{

    public function search(string $search):object{
        return Produit::where('nom','like',"%$search%")->get();
    }

    public function execute() : string {

        if ($this->http_method == "GET") {
            $nb_produits_par_pages = 5;
            $nb_produits = 0;
            $res = "<H2 class='font-bold ml-2 text-2xl text-center m-4 text-emerald-900'>Nos produits</H2>
            <form method='post' action='?action=catalogue&page=1&search'>
                <input size='30%' type ='search' name='search' placeholder='Rechercher un produit'>
            </form> 
                <div class='flex flex-row justify-between '>
                ";

            if (isset($_GET['search'])) {
                $produits = $this->search($_GET['search']);
                var_dump($produits);
            }else {
                $produits = Produit::get();
            }
            $tab = [];
            foreach ($produits as $produit) {
                $nb_produits++;

                $res .= <<< EOT
            <div class="bg-white drop-shadow-2xl rounded-2xl pl-3 pr-3 mx-2 mt-3 w-1/5 ">
            <div class="  flex justify-center">
                <img class="w-40 h-40 mt-2" src="BD_img/{$produit->id}.jpg" alt="{$produit->nom}">
            </div>    
                <h2 class="font-bold ">{$produit->nom}</h2>
                <div class="pb-16"><p >{$produit->description}</p></div>
                <div class="flex flex-row-reverse  fixed bottom-0 gap-8">
                    <p >{$produit->prix}€</p>
                    <a class="mb-2 hover:border-b-2 border-emerald-800 font-bold" href="index.php?action=produit&id={$produit->id}">Voir le produit</a>
                </div>
            </div>
            EOT;
                if ($nb_produits % $nb_produits_par_pages == 0) {
                    array_push($tab, $res);
                    $res = "<H2 class='font-bold ml-2 text-2xl text-center m-4 text-emerald-900'>Nos produits</H2>
                <div class='flex flex-row justify-between'>
                ";
                }
            }

            $res = $tab[$_GET['page'] - 1];

            $res .= "</div> <footer class='flex flex-row justify-center space-x-2 my-8 text-2xl'>";
            $nb_pages = ceil($nb_produits / $nb_produits_par_pages);
            for ($i = 1; $i <= $nb_pages; $i++) {
                $res .= '<a href="?action=catalogue&page=' . $i . '">' . $i . '</a> ';
            }
            $res .= "</footer>";
        }else{
            if (isset($_GET['search'])) {
                echo"ok";
                header('Location: ?action=catalogue&page=1&search='.$_POST['search']);
            }
        }

        return $res;
    }
}
