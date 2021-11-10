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

Branches par années

-   xxxx-p1-start : la branche contenant le code de départ du workshop Laravel, réalisé avec les étudiants de l'année xxxx
-   xxxx-p1-end : la branche contenant le code solution du workshop Laravel, réalisé avec les étudiants de l'année xxxx
-   xxxx-p2-start : la branche contenant le code de départ du workshop VueJS, réalisé avec les étudiants de l'année xxxx
-   xxxx-p2-end : la branche contenant le code solution du workshop VueJS, réalisé avec les étudiants de l'année xxxx

# Prérequis

Commencez par télécharger et installer les éléments suivants en fonction de votre système.

---

Vous pouvez choisir d'**utiliser d'autres outils** que ceux indiqués en dessous, mais **le support ne vous sera pas garanti si vous rencontrez des problèmes**.  
Garder en tête que le workshop sera réalisé pour les personnes possédant les prérequis recommandés en dessous.  
Si vous souhaitez utiliser d'autres outils, voici ce qu'il vous faut au minimum :

-   Un serveur web type Apache, Nginx, ...
-   Un système de base de données type MySQL, PostgreSQL, ...
-   PHP version >= 7.4
-   Composer version compatible avec la version de PHP installée
-   Un IDE type VS Code (recommandé) ou autre
-   Suivez les prochains chapitres afin de vous assurer de pouvoir suivre le workshop

> XAMPP propose un serveur web et un système de base de données tout en un si jamais vous souhaitez utiliser d'autre outils.

---

## Windows

### Docker Desktop

https://docs.docker.com/get-docker/

**IMPORTANT**

-   Il est important de lire et compléter la section **"System requirements"**, il est également fortement recommandé de lire et suivre tous les autres chapitres de cette page afin de s'assurer d'installer correctement Docker Desktop sur votre système.
-   Il est possible de choisir entre "WSL 2 Backend" ou "Hyper-V backend", les 2 options sont viables pour pouvoir suivre le workshop.

> WSL 2 = Windows Subsystem for Linux  
> Cela vous permet d'avoir une distribution Linux sur votre machine.  
> Documentez-vous un peu sur WSL 2 pour en savoir plus.

Si vous n'avez pas installé WSL 2 et que Docker Desktop vous affiche une erreur où il est marqué que WSL doit être activé ou quelque chose dans le genre, allez voir dans `C:\Users\<username>\AppData\Roaming\Docker\settings.json` et modifiez `wslEngineEnabled` à `false`.
Redémarrez Docker Desktop et voyez si le problème à disparu --> Clic droit sur l'icône Docker Desktop en bas à droite de Windows, puis "Restart Docker..."
Source : https://github.com/docker/for-win/issues/6122

### Visual Studio Code (recommandé) ou un autre IDE

-   VS Code : https://code.visualstudio.com/
-   WSL 2 : Si vous avez installé WSL 2, installez l'extension VS Code "Remote Development" téléchargeable ici ou directement sur VS Code : https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.vscode-remote-extensionpack

## Linux

### Docker

-   Docker : https://docs.docker.com/get-docker/
-   Docker Compose : https://docs.docker.com/compose/install/

### Visual Studio Code (recommandé) ou un autre IDE

-   VS Code : https://code.visualstudio.com/

# Récupérer le projet

Ce projet contient des submodules, veuillez utiliser la commande suivante pour cloner le projet et les submodules git :

```bash
git clone --recursive [URL to Git repo]
```

Si vous avez oublié d'utiliser `--recursive` dans la commande précédente, exécutez cette commande après avoir cloné le projet :

```bash
git submodule update --init laradock/
```

# Configurer le projet

Créez une copie du fichier `.env.example` situé dans le dossier `laradock` et renommez-le `.env`.

```bash
# Execute in laradock
cp .env.example .env
```

Ouvrez le fichier `.env` fraichement créé et modifiez les éléments suivants :

```bash
COMPOSE_PROJECT_NAME=workshop-laravel
PHP_VERSION=7.4
...
MYSQL_DATABASE=workshop
MYSQL_USER=homestead
MYSQL_PASSWORD=secret
...
NGINX_HOST_HTTP_PORT=8000
```

Démarrez les containers Docker utiles au projet (cela peut prendre quelques minutes la première fois, c'est normal).

```bash
# Execute in laradock
docker-compose up nginx mysql phpmyadmin redis workspace
```

Ou alors avec le paramètre `-d` pour ne pas bloquer la console.

```bash
# Execute in laradock
docker-compose up -d nginx mysql phpmyadmin redis workspace
```

Si jamais vous souhaitez stopper les containers Docker du workshop vous pouvez le faire avec la commande suivante.

```bash
# Execute in laradock
docker-compose stop
```

> Si Windwos vous demande s'il peut partager l'accès à Docker pour un répertoire ou un fichier, acceptez la requête.

Copiez le fichier `.env.example` à la racine du projet et renommez-le `.env`.

```bash
# Execute in project root
cp .env.example .env
```

Le contenu de ce fichier n'est pas à modifier, car il est déjà adapté à la configuration du projet.

> Si vous avez déjà utilisé "Laradock", adaptez les variables `DB_USERNAME` et `DB_PASSWORD` dans le fichier `.env` situé à la racine du projet. Et adaptez également les variables `MYSQL_USER` et `MYSQL_PASSWORD` dans le fichier `.env` situé dans le dossier `laradock`. Cela vous permettra de vous connecter à votre système de base de données existant.

Connectez-vous au container docker `workspace`, installez les dépendances et mettez le projet Laravel en place.

```bash
# Execute in laradock
docker-compose exec workspace bash
```

```bash
# Execute in workspace bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

# Tester que tout fonctionne

Essayez d'accéder à l'url : http://localhost:8000

Vous devriez avoir une page avec marqué "You are READY for the workshop ;)", sinon regardez dans les logs des différents containers Docker que vous avez exécuté pour comprendre ce qui n'a pas fonctionné.

> Astuce : si vous avez démarré vos containers avec le paramètre `-d`, vous pouvez ouvrir Docker Desktop et cliquer sur les containers pour voir leurs logs ou alors ouvrir un bash dans le dossier `laradock` et exécuter `docker-compose logs <nom_du_service>` (<nom_du_service> peut dans notre cas être l'un des éléments suivants : nginx mysql phpmyadmin redis workspace).

Si vous avez le résultat demandé, c'est que vous êtes normalement prêt à suivre le workshop :)

Sinon, c'est terrible ! Commencez par faire 3 tours sur vous même ou même un peu plus.  
Ensuite, assurez-vous de n'avoir oublié aucune des étapes et regardez également avec vos camarades qui pourraient également vous aider.

---

**La préparation du workshop s'arrête ici !**

Les points suivants vous seront utiles lorsque vous créerez votre propre projet.

Ils ne sont pas utiles pour la préparation au workshop !

---

# Comment initialiser un nouveau projet avec Laravel et Laradock

Avec ce chapitre vous pourrez créer et initialisez un nouveau projet Laravel avec Laradock (comme dans le workshop).  
L'objectif est d'avoir un projet qui vous permette d'utiliser la puissance de Docker en ayant un environnement de dev commun.

Sources utiles pour obtenir davantage de détails.

-   Laravel : https://laravel.com/docs/8.x/installation
-   Laradock : https://laradock.io/getting-started/

Voici les étapes :

0. Que souhaitez-vous faire ?
- Initialiser le projet pour la première fois : une seule personne dans le projet doit suivre les étapes suivantes au complet.
- Récupérer le projet : les co-équipiers doivent sauter les étapes avec la mention **(INIT-ONLY)**.
  - Avant de réaliser les prochaines étapes il faudra récupérer Laradock (voir le chapitre de ce README nommé "Récupérer le projet")
1. **(INIT-ONLY)** Créer un projet Github
2. **(INIT-ONLY)** Cloner le projet
3. **(INIT-ONLY)** Ouvrir un bash et ajouter le submodule Laradock au projet

```sh
git submodule add https://github.com/Laradock/laradock.git
```

4. **(INIT-ONLY)** Push les 2 fichiers créés : .gitmodules et laradock (le contenu de laradock ne doit PAS être poussé, seul un fichier nommé laradock doit être poussé)
5. Créer une copie du fichier `.env.example` situé dans le dossier laradock et le renommer `.env`
6. Ouvrir le fichier `.env` fraichement créé et modifier les éléments suivants (**attention certaines valeurs sont à remplacées**, lisez les commentaires suivants pour comprendre) :

> Vous pouvez mettre ce que vous voulez pour les valeurs "COMPOSE_PROJECT_NAME" et "MYSQL_DATABASE", mais ne mettez surtout PAS les mêmes valeurs que pour celle déjà durant le workshop. Essayez de rester cohérent dans une même équipe.

> Un .env ne doit JAMAIS être poussée sur git.

> Je vous conseille de rester avec PHP 7.4 (C'est se que vous aurez sur le serveur de déploiement)

> Le user et le password de MYSQL dépendent de votre config perso, mais en principe vous devrez mettre "homestead" et "secret" comme votre MySQL a été créé avec ce workshop. Sinon à vous de voir.

> Je vous conseille d'utiliser Nginx sur le port 8000, car le port 80 proposé de base est très souvent déjà utilisé par Windows (attention, le port doit être libre, mais généralement ce port est toujours libre, à moins que vous ayez un autre projet qui tourne actuellement, auquel cas il faudra l'arrêter ou changer de port)

```sh
COMPOSE_PROJECT_NAME=my-project-name
PHP_VERSION=7.4
...
MYSQL_DATABASE=myprojectdbname
MYSQL_USER=homestead
MYSQL_PASSWORD=secret
...
NGINX_HOST_HTTP_PORT=8000
```

7. Démarrer les services dont vous avez besoins, dans la plupart des cas les services suivants sont suffisants pour commencer en tout cas. Vous pourrez toujours ajouter des services par la suite.

> Cela peut prendre quelques minutes la première fois, c'est normal

```sh
# Execute in laradock
docker-compose up -d nginx mysql phpmyadmin redis workspace
```

8. Vérifier que les containers soient démarrés
9. Connectez-vous au container docker workspace

```sh
# Execute in laradock
docker-compose exec workspace bash
```

10. **(INIT-ONLY)** Créer votre projet Laravel

```sh
# Execute in workspace
composer create-project laravel/laravel my-project-name
```

11. **(INIT-ONLY)** Déplacer tout le contenu du dossier de projet Laravel qui vient d'être créé à la racine (optionnel, mais je recommande, car cela simplifie les commandes pour la suite)
12. **(INIT-ONLY)** Supprimer le dossier vide du projet Laravel
13. **(INIT-ONLY)** Push les nouveaux fichiers créés

> Vérifiez que votre `.gitignore` est à jour afin de push uniquement les fichiers utiles à votre projet.
> Le `.gitignore` fournit par Laravel au moment de créer le projet devrait suffire, mais vous pouvez également générer votre propre `.gitignore` à l'aide, par exemple, du site https://www.toptal.com/developers/gitignore (perso je recommande ce site).

14. Modifier le `.env` pour correspondre à votre configuration, si toutes les étapes ont étés suivies voici ce qu'il faudra modifier.

```sh
DB_HOST=mysql
DB_DATABASE=myprojectdbname
DB_USERNAME=homestead
DB_PASSWORD=secret
...
REDIS_HOST=redis
```

15. Créer la base de données pour votre projet

- Avec phpMyAdmin (accessible depuis http://localhost:8081 normalement) vous pouvez le faire en suivant ce tuto : http://webvaultwiki.com.au/Create-Mysql-Database-User-Phpmyadmin.ashx (Attention il y a des différences avec le tuto, lisez la suite avant de suivre le tuto)  
  - Attention il y 2 différences par rapport au tuto. Ne créez pas de nouvel utilisateur, attribuez la nouvelle BDD à "homestead" ou à l'utilisateur que vous souhaitez utiliser. Et donner tous les droits à cet utilisateur sur la nouvelle BDD, pas simplement une partie comme indiquer dans le tuto.  
  - Ces étapes devront être réalisées avec l'utilisateur root (mot de passe : root)

16. Installer les dépendances de base pour votre projet Laravel et démarrer les commandes de configurations de base.

```sh
# Execute in workspace
composer install
php artisan key:generate
php artisan migrate
```

17. Tester que tout fonctionne en accédant à http://localhost:8000, vous devriez avoir une page Laravel.

**IMPORTANT** une fois toutes ces étapes réalisées chez une personne, les co-équipiers peuvent réaliser toutes les étapes de leur côté. Attention néanmoins, vos co-équipiers auront quelques différences dans les étapes à effectuées, ce référer au point (0.) pour comprendre ce qu'ils doivent effectués.

---

# Ajouter VueJS avec laravel/breeze et Inertia à un nouveau projet Laravel

Une fois le projet initialisé avec les étapes indiquées ci-dessus, il est possible d'ajouter VueJS avec laravel/breeze et Inertia.

**ATTENTION** laravel/breeze doit être ajouté au début du projet pour éviter tout soucis, c'est pour cela que je vous recommande de faire ces étapes juste après avoir terminé les précédentes étapes.

> Ce n'est pas une obligation absolue, comme nous avons pu le voir lors du workshop, mais il faut vraiment savoir et comprendre ce que l'on fait.

0. Que souhaitez-vous faire ?
- Initialiser le projet pour la première fois : une seule personne dans le projet doit suivre les étapes suivantes au complet.
- Récupérer le projet : les co-équipiers doivent sauter les étapes avec la mention **(INIT-ONLY)**.
  - Avant de réaliser les prochaines étapes il faudra déjà avoir suivi le chapitre précédent (voir le chapitre de ce README nommé "Comment initialiser un nouveau projet avec Laravel et Laradock")

1. **(INIT-ONLY)** La première chose que nous allons faire c'est d'ajouter laravel/breeze (scaffolder/starter-kit officiel pour Laravel) à notre projet à l'aide de composer.

```sh
composer require laravel/breeze --dev
```

2. **(INIT-ONLY)** Une fois laravel/breeze ajouté au projet, nous allons pouvoir l'utiliser. Dans notre cas nous souhaitons utiliser la version avec VueJS.

> La solution de laravel/breeze avec VueJS vient également avec Inertia.

```sh
php artisan breeze:install vue
```

Maintenant nous avons un projet avec laravel/breeze, VueJS et Inertia.

Inertia vient avec VueJS mais également tailwindcss, qui est très puissant, mais également plus complexe que Bootstrap par exemple.

3. **(INIT-ONLY)** Si vous souhaitez utiliser tailwindcss, vous pouvez sauter les étapes concernant la conversion de tailwindcss à bootstrap et reprendre depuis l'étape (7.).

4. **(INIT-ONLY)** Afin d’utiliser Bootstrap à la place de tailwindcss, nous allons utiliser un package bien pratique. Ce package va convertir notre code tailwindcss en bootstrap.

> Le package a été créé pour Jetstream qui fournit également tailwindcss par défaut, mais le créateur du package a créé une version pour laravel/breeze + inertia.

D'abord il nous ajouter le package à notre projet à l'aide de composer.

```sh
composer require nascent-africa/jetstrap --dev
```

5. **(INIT-ONLY)** Puis utiliser le package pour convertir le code tailwindcss en bootstrap.

```sh
php artisan jetstrap:swap breeze-inertia
```

6. **(INIT-ONLY)** Il reste encore à supprimer tailwindcss et ses éventuels plugins du projet. Pour se faire direction package.json et supprimer tous les packages contenant tailwindcss dans leur nom.

7. Installer les nouvelles dépendances npm avec

```sh
npm install
```

8. Et exécuter

```sh
npm run dev
```

Vous devriez avoir un message qui ressemble à cela :

Laravel Mix v6.0.39  
✔ Compiled Successfully in 10186ms

> **ATTENTION** Il est possible qu'il faille exécuter cette commande une 2ème fois. Si vous n'avez pas le message indiqué au dessus, une page blanche ou le mauvais contenu sur votre page, essayez d'exécuter la commande une 2ème fois et de faire `ctrl + f5` pour rafraîchir le cache du navigateur.

9. **(INIT-ONLY)** Push les nouveaux fichiers

> Vérifiez que votre `.gitignore` est à jour afin de push uniquement les fichiers utiles à votre projet.

10. Tester que tout fonctionne en accédant à http://localhost:8000, vous devriez avoir une page Laravel avec un bouton login et register en haut à gauche. Vous pouvez tester de vous créer un compte pour vérifier que tout fonctionne correctement, si c'est le cas, vous devriez être prêt :)

**IMPORTANT** une fois toutes ces étapes réalisées chez une personne, les co-équipiers peuvent réaliser toutes les étapes de leur côté. Attention néanmoins, vos co-équipiers auront quelques différences dans les étapes à effectuées, ce référer au point (0.) pour comprendre ce qu'ils doivent effectués.

> Si vous avez des soucis n'hésitez pas à me contacter par mail ou autre.

## Sources

Source pour laravel/breeze : https://laravel.com/docs/8.x/starter-kits

Source du package : https://github.com/nascent-africa/jetstrap

Documentation Inertia : https://inertiajs.com/

# Problèmes et solutions connues

## npm run dev

-   `npm run dev` provoque des erreurs dans la console (permission denied)

> Problème lors de l'utilisation avec Laradock

```bash
cd /home/laradock
rm -rf .npm
cd /var/www
rm package-lock.json
npm install
npm run dev
```

## Docker - mysql_1 crash

### Problème

Après le démarrage des conteneurs et quelques secondes plus tard le conteneur **mysql_1** peut s'éteindre.
Voici, l'un des messages d'erreur qui est affichée dans les logs du conteneur.
> Avec Docker Desktop, il est possible d'afficher les logs d'un conteneur en cliquant dessus

"Different lower_case_table_names settings for server ('0') and data dictionary ('2')"

La source du problème exact n'est pas connu, mais il est possible que cela survienne lorsqu'il y a déjà une ou plusieurs base de données créées par d'autres projets qui utilisent Laradock (comme le workshop par exemple). Cela pourrait aussi survenir lors d'un changement de WSL2 à Hyper-V.

### Solution

**ATTENTION**: Les actions proposées dans la solution suivante vont **supprimer** les bases de données utilisées dans tous les projets utilisant Laradock. Cette action est **irréversible**.

Avant de commencer, il est nécessaire d'éteindre tous les conteneurs du projet.
```sh
# Execute in laradock
docker-compose stop
```

Puis, supprimer dans Docker Desktop, tous les conteneurs MySQL de tous les projets utilisant Laradock
> Dans l'onglet Doker Desktop -> Containers/Apps, et appuyer sur le bouton "delete"

Ensuite, se rendre dans le dossier où sont contenues les sauvegardes des bases de données du conteneur msyql
> `C:\Users\nom d'utilisateur\.laradock\data`

Dans ce dossier, vous pouvez supprimer le dossier **mysql**.
> Il est possible que la suppression ne puisse pas se faire. Dans ce cas-là, contrôlé que bien tous les conteneurs sont arrêtés.

Vous pouvez reprendre depuis l'étape 7 du chapitre "Comment initialiser un nouveau projet avec Laravel et Laradock" et voir si cela à résolu votre problème.
