![Jusdepixel Community](https://community.jusdepixel.fr/logo.png)  

### Objectif
Créer un système de récupération automatique des posts d'une page Instagram

***
### Consignes
> Récupérer les derniers posts (donc quelques posts pas tous ceux de la page) et les afficher sur une page.  
> Cette récupération doit prendre en compte l'utilisation en production.  
> Nous nous concentrons ici surtout sur l'aspect back-end.  
> Il n'est évidemment pas nécessaire que ce soit ta propre page Instagram.

***
![Jusdepixel Community](https://img.shields.io/badge/coverage-88%25-yellowgreen)
#### Backend API : Laravel 9 / SQLite
#### Frontend : ReactJS / Typescript

***
### Comment je vois le projet
Créer un site communautaire où chaque utilisateur pourra partager un/plusieurs de ses posts, qui seront regroupés sur un seul fil.
On utilisera l'authentification Meta pour identifier l'utilisateur. Il faudra prendre en compte le refresh du long life token (60 jours), le refresh des medias (surprise !), et le taux d'utilisation de l'API Instagram.

***
### Installation
Config Instagram application <strong>.env</strong>
```
INSTAGRAM_CLIENT_ID=INSTAGRAM_CLIENT_ID
INSTAGRAM_CLIENT_SECRET=INSTAGRAM_CLIENT_SECRET
INSTAGRAM_REQUEST_URI=INSTAGRAM_REQUEST_URI
```
Install / Build / Serve
```
composer install
yarn install
yarn build
php artisan migrate
php artisan serve
```

***
### Liens 
Doc API : [https://community.jusdepixel.fr/request-docs](https://community.jusdepixel.fr/request-docs)  
Démo : [https://community.jusdepixel.fr/](https://community.jusdepixel.fr/) 
