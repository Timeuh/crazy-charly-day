<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Panier;
use custumbox\classes\data\Produit;

class ProduitAffichage
{
    public function execute(): string
    {
        $produit = Produit::where([
            ['id', '=', $_GET['id']]
        ])->first();
        $idProduit = $produit->id;
        if (unserialize($_SESSION['user']) != null) {
            $form = <<< form
                    <form action="index.php?action=produit&id=$idProduit" method="post" class="flex justify-around items-center">
                        <p class="font-bold">Quantité <input type="number" name="quantite" id="quantite" value="1" min="1" max="99" 
                        class="border-2 rounded-md border-yellow-500 text-center"></p>
                        <button class="formSubmit" type="submit">Ajouter au panier</button>
                    </form>
            form;
        }else{
            $form = <<< form
                    <form action="index.php?action=connexion" class="flex justify-around items-center">
                        <p class="font-bold">Quantité <input type="number" id="quantite" value="1" min="1" max="99" 
                        class="border-2 rounded-md border-yellow-500 text-center"></p>
                        <button class="formSubmit" type="submit">Ajouter au panier</button>
                    </form>
            form;
        }
        $categorie = $produit->categorie()->first();
        $res = <<< EOT
            <div class="flex flex-row justify-center items-center h-full">
                <div class="border-2 my-4 mx-8 rounded-md border-emerald-900 p-4">
                    <img src="BD_img/{$produit->id}.jpg" alt="{$produit->nom}" class="pt-12">
                </div>
                <div class="w-2/5 border-2 border-emerald-900 rounded-md space-y-12 p-4 m-4">
                    <div>
                        <h2 class="text-4xl font-bold text-yellow-500">{$produit->nom}</h2>
                    <div class="flex flex-row justify-between">
                        <h3 class="text-xl italic font-bold text-emerald-900">{$categorie->nom}</h3>
                        <a href="index.php?action=catalogue&page=1" class="formSubmit">Catalogue</a>
                    </div>
                        <p class="text-2xl py-4 text-yellow-500">{$produit->prix}€</p>
                    </div>
                    <div class="space-y-2 italic">
                        <p>{$produit->description}</p>
                        <p>{$produit->detail}</p>
                    </div>
                    {$form}
                </div>
            </div>
            EOT;

        if (isset($_POST['quantite']) && isset($_SESSION['user'])) {
            $pannier = unserialize($_SESSION['user'])->produits();
            if ($pannier->where('idproduit', '=', $idProduit)->exists()) {
                $produit = $pannier->where('idproduit', '=', $idProduit)->first();
                $qtq = $produit->panier->quantite;
                $qtq += $_POST['quantite'];
                $pannier->updateExistingPivot($idProduit, ['quantite' => $qtq]);
            } else {
                $pannier->attach($idProduit, ['quantite' => $_POST['quantite']]);
            }
        }

        return $res;
    }
}
