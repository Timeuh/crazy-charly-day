# Crazy Charly Day 2023

## Qu'est-ce que c'est ?
Il s'agit d'un challenge organisé par l'IUT Charlemagne de Nancy. 

Le but : les étudiants s'affrontent par équipe de 5 sur un sujet commun de développement d'une 
application web. Les meilleurs projets en termes de finition et d'ergonomie sont 
ensuite récompensés.

## Qui sommes-nous ?

Notre équipe porte le nom de ***Crazy Frog*** et est composée de 5 membres
en 2e année de BUT Informatique

- Timothée Brindejonc
- Gregory Dardenne
- Brenann Joly
- Nathan Melbeck
- Jules Steelandt

## Composition du projet

![Javascript](https://img.shields.io/badge/JS-Front--End%20Javascript-yellow?style=for-the-badge&logo=javascript)

![Tailwind CSS](https://img.shields.io/badge/Tailwind-Front--End%20CSS-blue?style=for-the-badge&logo=tailwindcss)

![PHP](https://img.shields.io/badge/PHP-Back--End%20PHP-blue?style=for-the-badge&logo=php&color=9370DB)

## Comment utiliser ce projet ?

Pour utiliser ce projet, il vous faut d'abord cloner le dépôt :

    git clone git@github.com:Timeuh/crazy-charly-day.git

Puis une fois le projet ouvert dans votre IDE préféré, installez les dépendances :

    composer install

Enfin, il ne reste plus qu'à lancer la surveillance tailwind css :

    npx tailwindcss -i ./www/styles/index.css -o ./www/styles/output.css --watch

Il vous faut un moyen de regarder votre code en local, avec Xampp ou WSL par exemple
