<?php

namespace custumbox\classes\afficheur;

use custumbox\classes\data\Produit;

class AccueilAffichage
{
    public function execute() : string {
        $res = <<<HTML
<div class="bg-cover  h-screen" style="background-image: url('documents/img_acc.jpg');">
  <div class="py-8 px-4 bg-white max-w-7xl mx-auto bg-opacity-80">
    <p>Bandeau d'information 1</p>
  </div>
  <div class="mt-8 py-8 px-4 bg-gray-200 max-w-7xl mx-auto bg-opacity-80">
    <p>Bandeau d'information 2</p>
  </div>
  <div class="mt-8 py-8 px-4 bg-white max-w-7xl mx-auto bg-opacity-80">
    <p>Bandeau d'information 3</p>
  </div>
</div>


HTML;
        return $res;
    }
}
