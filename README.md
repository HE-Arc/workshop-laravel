# Introduction

Workshop Laravel donné aux étudiants de 3ème année à la HE-Arc dans le cadre du cours de développement web.

L'objectif de ce workshop est de transmettre aux étudiants les bases et les bonnes pratiques de la création d'un projet web avec le Framework Laravel. Ce workshop a également pour but de fournir un point de départ aux étudiants afin de leur permettre de créer leur projet de semestre.

Les prochaines étapes permettent de mettre en place l'environnement de développement et de suivre le workshop dans son intégralité.

# Explication des branches

Branches générales

-   main : la branche contenant la version du README le plus à jour
-   p1-start : la branche contenant le code de départ du workshop Laravel
-   p1-end : la branche contenant le code solution du workshop Laravel
-   p2-start : la branche contenant le code de départ du workshop VueJS
-   p2-end : la branche contenant le code solution du workshop VueJS

Branches par année

-   xxxx-main : la branche contenant la version du README le plus à jour, réalisé pour les étudiants de l'année xxxx
-   xxxx-p1-start : la branche contenant le code de départ du workshop Laravel, réalisé avec les étudiants de l'année xxxx
-   xxxx-p1-end : la branche contenant le code solution du workshop Laravel, réalisé avec les étudiants de l'année xxxx
-   xxxx-p2-start : la branche contenant le code de départ du workshop VueJS, réalisé avec les étudiants de l'année xxxx
-   xxxx-p2-end : la branche contenant le code solution du workshop VueJS, réalisé avec les étudiants de l'année xxxx

# Prérequis

Commencez par télécharger et installer les éléments suivants en fonction de votre système.

1. XAMPP compatible avec PHP >= 8.0.2 (recommandé version 8.1.x) : https://www.apachefriends.org/download.html
2. Composer (recommandé dernière version disponible) : https://getcomposer.org/download/
3. VS Code : https://code.visualstudio.com/Download
4. Git : https://git-scm.com/

Vous pouvez choisir d'**utiliser d'autres outils** que ceux indiqués en dessous, mais **le support ne vous sera pas garanti si vous rencontrez des problèmes**.  
Garder en tête que le workshop a été conçu en utilisant les prérequis recommandés en dessous.  
Si vous souhaitez utiliser d'autres outils, voici ce qu'il vous faut au minimum :

-   Un serveur web : PHP built-in server, Apache, Nginx, ...
-   Un système de base de données : MySQL, PostgreSQL, ...
-   PHP version >= 8.0.2
-   Composer version compatible avec la version de PHP installée
-   Un IDE : VS Code (recommandé) ou autre
-   Git : Une version assez récente devrait suffire
-   Suivez les prochains chapitres afin de vous assurer de pouvoir suivre le workshop

Si Docker vous intéresse, vous pouvez utiliser Laradock. C'est un très bon outil vous fournissant des conteneurs Docker de base pour travailler avec Laravel et Docker.
> En pratique il y a de fortes chances pour que vous soyez amené à utiliser Docker à l'avenir. Mais le workshop se concentre sur Laravel, nous allons donc peu ou pas aborder Docker.

# Récupérer le projet

Récupérez le projet en SSH (recommandé) ou en HTTPS.

> Si vous récupérez le projet via SSH, il faudra configurer une clé SSH sur votre machine si cela n'est pas déjà fait.
> Et configurer la clé publique sur GitHub.
> Pour générer une clé SSH : https://docs.oracle.com/en/cloud/cloud-at-customer/occ-get-started/generate-ssh-key-pair.html

```bash
git clone [URL to Git repo]
```

# Configurer le projet

Copiez le fichier `.env.example` à la racine du projet et renommez-le `.env`.

```bash
# Execute in project root
cp .env.example .env
```

> Le contenu de ce fichier n'est pas à modifier, car il est déjà adapté à la configuration du projet.  
> Si vous aviez déjà une base de données installée, il faudra peut être adapté ce fichier quand même.  
> Notamment les paramètres `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` et/ou d'autres dépendants de votre configuration locale.

Créez une nouvelle base de données manuellement.
1. Ouvrez le panneau de contrôle XAMPP et démarrez `MySQL` et `Apache` en appuyant sur le bouton `Start` sur chaque ligne.
2. Toujours sur le panneau de contrôle XAMPP, appuyez sur le bouton `Admin` sur la ligne `MySQL`, cela ouvre PhpMyAdmin sur un navigateur
2. Cliquez sur "nouvelle base de données"
3. Nommez-la `workshop-laravel`, assurez-vous également que `utf8mb4_general_ci` soit sélectionné, et appuyez sur "créer".

> Durant le workshop nous n'utiliserons pas le serveur fourni par Apache, mais ici il est nécessaire de  
> le démarrer quand même, car nous avons besoin de PhpMyAdmin qui est démarré avec le même bouton.  
> En pratique ces 2 éléments ne sont pas liés, il est tout à fait possible d'avoir Apache démarré sans  
> PhpMyAdmin et inversement. XAMPP a décidé de les lier, mais ce n'est qu'un choix.

Installez les dépendances et mettez le projet Laravel en place.

```bash
# Execute in workspace bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

> Si la commande `php artisan migrate` échoue avec une erreur similaire à :  
> `SQLSTATE[HY000] [1049] Unknown database 'laravel' (SQL: select * from information_schema.tables where table_schema = laravel and table_name = migrations and 
table_type = 'BASE TABLE')`  
> Cela veut probablement dire que votre base de données n'a pas été correctement créée.

Démarrez le serveur de développement fourni par PHP.

```bash
php artisan serve
```

> Si vous souhaitez utiliser Apache fourni par XAMPP à la place du serveur fourni par PHP vous pouvez suivre ce tutoriel :  
> Seules certaines étapes seront nécessaires, car nous avons déjà fait la plupart des choses.
> https://wecode101.com/xampp-development-environment-for-laravel-8
> Mais cette étape n'est pas obligatoire, le serveur de développement fonctionne et suffi.

# Tester que tout fonctionne

Essayez d'accéder à l'URL : http://localhost:8000

Vous devriez avoir une page avec marquée "You are READY for the workshop ;)", sinon regardez dans les logs pour comprendre ce qui n'a pas fonctionné.

Si vous avez le résultat demandé, c'est que vous êtes normalement prêt à suivre le workshop :)

Sinon, c'est terrible ! Commencez par faire 3 tours sur vous-même ou même un peu plus.  
Ensuite, assurez-vous de n'avoir oublié aucune des étapes et regardez également avec vos camarades qui pourraient également vous aider.

---

**La préparation du workshop s'arrête ici !**

Les points suivants vous seront utiles lorsque vous créerez votre propre projet.

Ils ne sont pas utiles pour la préparation au workshop !

---

# Comment initialiser un nouveau projet avec Laravel

La documentation de Laravel est très complète et permet de démarrer un nouveau projet en un rien de temps.

https://laravel.com/docs/9.x/installation#your-first-laravel-project
