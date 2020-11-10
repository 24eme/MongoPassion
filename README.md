***<h1 align="center">MongoPassion</h1>***

Application web de gestion de bases de données MongoDb (NoSQL)

_Lire en d'autres langues: [Français](README.md), [English](README.en.md)_

# Aperçu de l'application

<img src="/public/images/capture_home.png"/>

- MongoPassion permet de se connecter à mongodb en s'authentifiant si nécessaire.

<img src="/public/images/capture_getServer_censored.jpg" width="330" /> <img src="/public/images/capture_getDb.png" width="330" /> <img src="/public/images/capture_getCollection.png" width="330" />

- La fonctionnalité principale de l’application est de permettre l’affichage et la modification du contenu de chaque base, collection ou document présent sur vos serveurs.

<img src="/public/images/capture_editDoc.png" width="495" /> <img src="/public/images/capture_console.png" width="495" />

- L’application propose également deux modes d’édition de documents : un mode json basique d’une part et d’autre part la possibilité d’utiliser l’outil JsonEditor.

- MongoPassion propose également plusieurs systèmes de recherche : une recherche de document par ID directement depuis la base de données, une recherche de documents par ID ou par contenu dans une collection et une recherche plus libre en console directement en ligne de commande JavaScript.

# Installation

## Prérequis
- PHP 7-* <br/>
- Apache2

## Installation du package php-mongodb
    $ sudo pecl mongodb

## Dépôt Git
 - Clônez le projet dans /var/wwww/html <br/>
 - Placez-vous dans le dossier du projet (MongoPassion)
 
# En cas de package manquants
 
## Installation manuelle des dépendances Mongo avec Composer : 
    $ composer require mongodb/mongodb

## Installation manuelle de JsonEditor avec npm :
 - Placez vous dans le répertoire MongoPassion
 - Clonez les fichiers à partir du git :
 
       $  git clone https://github.com/josdejong/jsoneditor.git
 - Installez jsoneditor :
    
       $  npm install jsoneditor
 - Placez-vous dans le dossier jsoneditor, copiez le fichier package.json puis collez le dans le dossier MongoPassion
 - Placez-vous dans le dossier MongoPassion
 - Poursuivez l'installation :
            
       $  npm install
       
 - Déplacez le dossier node_modules et les fichiers package.json et package-lock.json dans le dossier jsoneditor
 - Placez vous dans le dossier jsoneditor
 - Finalisez l'installation :
 
       $  npm run build
