<?php

namespace custumbox\classes\afficheur;

class AProposAffichage extends Action {

    public function execute(): string {
        return "
        <div class='bg-emerald-700 h-screen text-yellow-500 flex flex-col items-center space-y-12'>
             <h1 class='text-4xl font-bold pt-4'>Pourquoi ce site ?</h1>
             <div class='space-y-12 w-3/5 text-xl'> 
                 <p>Ce site est créé à l'occasion du Crazy Charly Day, un évènement organisé par l'IUT Charlemagne de Nancy
                    pour challenger ses différentes promotions de 2e années sur leurs acquis en produisant un projet concret pour une 
                    association.</p>
                <p>Cette année, l'association Court-Circuit à été choisie. Elle propose de la vente de produits locaux bio et pas cher,
                 et tous les bénéfices sont réinjectés dans l'infrastructure.</p>    
                 <p>
                 Concernant l'équipe, nous sommes l'équipe Crazy Frog, composée de 5 membres :
                </p>     
             </div>
            <div class='flex flex-col space-y-4 text-green-300 justify-center text-2xl'>
                <a href='https://github.com/Timeuh' class='hover:text-yellow-600 border-2 border-yellow-500 rounded-md p-2'>Timothée Brindejonc</a>
                <span class='border-2 border-yellow-500 rounded-md p-2'>Gregory Dardenne</span>
                <span class='border-2 border-yellow-500 rounded-md p-2'>Brenann Joly</span>
                <span class='border-2 border-yellow-500 rounded-md p-2'>Nathan Melbeck</span>
                <a href='https://github.com/Soniii79' class='hover:text-yellow-600 border-2 border-yellow-500 rounded-md p-2'>Jules Steelandt</a>
            </div>
        </div>
        ";
    }
}
