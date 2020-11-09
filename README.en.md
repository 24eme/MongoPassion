<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


***<h1 align="center">Interface-MongoDB</h1>***

_Read in other languages: [Français](README.md), [English](README.en.md)_

## Prerequesites
- PHP 7-* <br/>
- Apache2

## Installation of the php-mongodb package
    $ sudo pecl mongodb

## GitHub Repository
 - Clone the repository in /var/wwww/html <br/>
 - Cd into the project folder (Interface-MongoDB)
 
# <i class="fa fa-fw fa-warning"></i> In case of a missing package
 
## Manual installation of Mongo dependencies with Composer : 
    $ composer require mongodb/mongodb

## Manual installation of JsonEditor with npm :
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

