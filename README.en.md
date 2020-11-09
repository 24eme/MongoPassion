***<h1 align="center">Interface-MongoDB</h1>***

Web-based project for management of MongoDB databases

_Read in other languages: [Français](README.md), [English](README.en.md)_

# Installation

## Prerequesites
- PHP 7-* <br/>
- Apache2

## Installation of the php-mongodb package
    $ sudo pecl mongodb

## GitHub Repository
 - Clone the repository in /var/wwww/html <br/>
 - Cd into the project folder (Interface-MongoDB)
 
# In case of a missing package
 
## Manual installation of Mongo dependencies with Composer : 
    $ composer require mongodb/mongodb

## Manual installation of JsonEditor with npm :
 - Cd into the Interface-MongoDB directory
 - Clone jsoneditor files from GitHub :
 
       $  git clone https://github.com/josdejong/jsoneditor.git
 - Install jsoneditor :
    
       $  npm install jsoneditor
 - Cd into the jsoneditor folder, copy the package.json file then paste it in the Interface-MongoDB directory
 - Cd into the Interface-MongoDB directory
 - Continue with the installation :
            
       $  npm install
       
 - Move the node_modules folder and package.json and package-lock.json files in the jsoneditor folder
 - Cd into the jsoneditor folder
 - Complete the installation :
 
       $  npm run build

