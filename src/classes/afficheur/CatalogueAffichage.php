<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Produit;

class CatalogueAffichage
{
    public function execute() : string {
        $nb_produits_par_pages = 5;
        $nb_produits = 0;
        $res = "<H2 class='font-bold ml-2 text-2xl'>Nos produits</H2>
                <div class='flex flex-row justify-between '>
                ";
        $produits = Produit::get();
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
                    <a class="mb-2 hover:border-b-2 border-emerald-800" href="index.php?action=produit&id={$produit->id}">Voir le produit</a>
                </div>
            </div>
            EOT;
            if ($nb_produits%$nb_produits_par_pages==0){
                array_push($tab,$res);
                $res = "<H2 class='font-bold ml-2 text-2xl'>Nos produits</H2>
                <div class='flex flex-row justify-between '>
                ";
            }
        }

        $res = $tab[$_GET['page']-1];

        $res .= "</div> <footer class=''>";
        $nb_pages = ceil($nb_produits / $nb_produits_par_pages);
        for ($i = 1; $i <= $nb_pages; $i++) {
            $res .= '<a href="?action=catalogue&page=' . $i . '">' . $i . '</a> ';
        }
        $res.="</footer>";

        return $res;
    }
}
