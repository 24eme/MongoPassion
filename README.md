# ---------------------Interface-MongoDB--------------------------------------
# ---------------------------------------------------------------------------------

## Prerequis
#### Installez PHP 7-*
#### Apache2

### Driver MongoDB
 $ git clone https://github.com/mongodb/mongo-php-driver.git
 $ cd mongo-php-driver
 $ git submodule update --init
 $ phpize
 $ ./configure
 $ make all
 $ sudo make install

## depôt git
 Clônez le projet dans /var/wwww/html <br/>
 Placez-vous dans le dossier du projet (Interface-MongoDB)
 
 ## Installez les dépendances avec Composer : 
    $ composer require mongodb/mongodb
 
### Depuis le navigateur vous pouvez accéder au projet 
#### localhost/Interface-MongoDB
