<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Commande;

class AfficheurCommande
{
    public function execute() : string {
        $res = "";
        if(isset($_POST['date'])) {
            $commande = new Commande();
            $commande->save();
            $date = $_POST['date'];
            $panier = unserialize($_SESSION['user'])->produits;
            foreach ($panier as $produit) {
                $commande->contient()->attach(
                    $produit->id,
                    ['quantite' => $produit->panier->quantite]
                );
                $produit->panier->delete();
            }
            $commande->factures()->attach(
                $_SESSION['user']->id,
                ['dateRetrait' => $date]
            );
            $res = "<p>Commande validée pour le $date</p>";
            header('Location: index.php?action=panier');
        } else {
            $res = <<<HTML
                <form action="index.php?action=commande" method="post" class="bg-teal-800 h-screen text-center text-2xl text-yellow-500 flex flex-col items-center space-y-4">
                    <label for="date" >Date de retrait</label>
                    <input type="date" name="date" id="date" class="formInput">
                    <input type="submit" value="Valider" class="formSubmit">
                </form>
            HTML;
        }

        return $res;
    }
}
