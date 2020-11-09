
***<h1 align="center">Interface-MongoDB</h1>***

_Lire en d'autres langues: [Français](README.md),_

## Prérequis
- PHP 7-* <br/>
- Apache2

## Installation du package php-mongodb
    $ sudo pecl mongodb

## Dépôt Git
 - Clônez le projet dans /var/wwww/html <br/>
 - Placez-vous dans le dossier du projet (Interface-MongoDB)
 
 ## Installez les dépendances Mongo avec Composer : 
    $ composer require mongodb/mongodb

 ## Installez JsonEditor avec npm :
 - Placez vous dans le répertoire Interface-MongoDB
 - Clonez les fichiers à partir du git :
 
       $  git clone https://github.com/josdejong/jsoneditor.git
 - Installez jsoneditor :
    
       $  npm install jsoneditor
 - Placez-vous dans le dossier jsoneditor, copiez le fichier package.json puis collez le dans le dossier Interface-MongoDB
 - Placez-vous dans le dossier Interface-MongoDB
 - Poursuivez l'installation :
            
       $  npm install
       
 - Déplacez le dossier node_modules et les fichiers package.json et package-lock.json dans le dossier jsoneditor
 - Placez vous dans le dossier jsoneditor
 - Finalisez l'installation :
 
       $  npm run build

