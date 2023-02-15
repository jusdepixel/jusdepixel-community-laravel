  
  
![Légende](https://community.jusdepixel.fr/logo.png)

### Objectif
Créer un système de récupération automatique des posts d'une page Instagram

***
### Consignes
> Récupérer les derniers posts (donc quelques posts pas tous ceux de la page) et les afficher sur une page.  
> Cette récupération doit prendre en compte l'utilisation en production.  
> Nous nous concentrons ici surtout sur l'aspect back-end.  
> Il n'est évidemment pas nécessaire que ce soit ta propre page Instagram.

***
### Installation

```
git clone git@github.com:jusdepixel/jusdepixel-community-laravel.git ./
composer install
yarn install
yarn build
php artisan migrate
```

### Environnement
Ajouter (ou decrypter le .env.encrypted)

```
INSTAGRAM_CLIENT_ID=INSTAGRAM_CLIENT_ID
INSTAGRAM_CLIENT_SECRET=INSTAGRAM_CLIENT_SECRET
INSTAGRAM_REQUEST_URI=INSTAGRAM_REQUEST_URI
```

***
### Démo
[https://community.jusdepixel.fr/](https://community.jusdepixel.fr/)
