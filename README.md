# Introduction

Workshop Laravel donné aux étudiants de 3ème année à la HE-Arc dans le cadre du cours de dévelopement web.

L'objectif de ce workshop est de transmettre aux étudiants les bases et les bonnes pratique de la création d'un projet web avec le Framework Laravel. Ce workshop a également pour but de fournir un point de départ aux étudiants afin de leur permettre de créer leur projet de semestre.

Les prochaines étapes permettent de mettre en place l'environement de dévelopement et de suivre le workshop dans son intégralité.

# Prérequis

Commencez par télécharger et installer les éléments suivants en fonction de votre système.

---
Vous pouvez choisir d'**utiliser d'autres outils** que ceux indiqués en dessous, mais **le support ne vous sera pas garanti si vous rencontrez des problèmes**.  
Garder en tête que le workshop sera réalisé pour les personnes possédant les prérequis recommandés en dessous.  
Si vous souhaitez utiliser d'autres outils, voici ce qu'il vous faut au minimum :
- Un server web type Apache, Nginx,...
- Un système de base de données type MySQL, Postgres,...
- PHP version >= 7.4
- Composer version compatible avec la version de PHP installée
- Un IDE type VSCode (recommandé) ou autre
- Suivez les prochains chapitres afin de vous assurer de pouvoir suivre le workshop

> XAMPP propose un serveur web et un système de base de données tout en un si jamais vous souhaitez utiliser d'autre outils.
---

## Windows

### Docker Desktop
https://docs.docker.com/get-docker/

**IMPORTANT**
- Il est important de lire et compléter la section **"System requirements"**, il est également fortement recommandé de lire et suivre tous les autres chapitres de cette page afin de s'assurer d'installer correctement Docker Desktop sur votre système.
- Il est possible de choisir entre "WSL 2 Backend" ou "Hyper-V backend", les 2 options sont viables pour pouvoir suivre le workshop.

> WSL 2 = Windows Subsystem for Linux  
> Cela vous permet d'avoir une distribution Linux sur votre machine.  
> Documentez-vous un peu sur WSL 2 pour en savoir plus.  

Si vous n'avez pas installé WSL 2 et que Docker Desktop vous affiche une erreur où il est marqué que WSL doit être activé ou quelque chose dans le genre,
allez voir dans `C:\Users\<username>\AppData\Roaming\Docker\settings.json` et modifiez `wslEngineEnabled` à `false`.
Redémarrez Docker Desktop et voyez si le problème à disparu --> Clique droit sur l'icone Docker Desktop en bas à droite de Windows, puis "Restart Docker..."
Source : https://github.com/docker/for-win/issues/6122

### Visual Studio Code (recommandé) ou un autre IDE
- VSCode : https://code.visualstudio.com/
- WSL 2 : Si vous avez installé WSL 2, installez l'extention VSCode "Remote Development" téléchargeable ici ou directement sur VSCode : https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.vscode-remote-extensionpack

## Linux

### Docker
- Docker : https://docs.docker.com/get-docker/
- Docker Compose : https://docs.docker.com/compose/install/

### Visual Studio Code (recommandé) ou un autre IDE
- VSCode : https://code.visualstudio.com/

# Récupérer le projet

Ce projet contient des submodules, veuillez utiliser la commande suivante pour cloner le projet et les submodules git :  
```bash
git clone --recursive [URL to Git repo]
```

Si vous avez oublié d'utiliser `--recursive` dans la commande précédente, executez cette commande après avoir cloné le projet :  
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

ou alors avec le paramètre `-d` pour ne pas bloquer la console.
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

# Comment initialiser un nouveau projet

Avec ce chapitre vous pourrez créez et initialisez un nouveau projet Laravel avec Laradock (comme dans le workshop).  
L'objectif est d'avoir un projet qui vous permette d'utiliser la puissance de Docker en ayant un environement de dev commun.

Sources utiles pour obtenir d'avantage de détails.
- Laravel : https://laravel.com/docs/8.x/installation
- Laradock : https://laradock.io/getting-started/

Voici les étapes :
1. Créer un projet Github
2. Cloner le projet
3. Ouvrir un bash et ajouter le submodule Laradock au projet
```sh
git submodule add https://github.com/Laradock/laradock.git
```
4. Push les 2 fichiers créés : .gitmodules et laradock (le contenu de laradock ne doit PAS être poussé, seul un fichier nommé laradock doit être poussé)
> Vos co-équipiés peuvent pull à partir d'ici et faire les mêmes étapes de leur côté. ATTENTION néanmoins, vos co-équipiés devront récupérer Laradock (voir le chapitre de ce README nommé "Récupérer le projet").
5. Créer une copie du fichier `.env.example` situé dans le dossier laradock et le renommer `.env`
6. Ouvrir le fichier `.env` fraichement créé et modifier les éléments suivants (**attention certaines valeures sont à remplacées**, lisez les commentaires suivants pour comprendre) :
> Vous pouvez mettre se que vous voulez pour les valeurs "COMPOSE_PROJECT_NAME" et "MYSQL_DATABASE", mais ne mettez surtout PAS les même valeur que pour celle déjà durant le workshop. Essayez de rester cohérent dans une même équipe.

> Un .env ne doit JAMAIS être poussée sur git.

> Je vous conseille de rester avec PHP 7.4 (C'est se que vous aurez sur le serveur de déploiement)

> Le user et le password de MYSQL dépendent de votre config perso, mais en principe vous devrez mettre "homestead" et "secret" comme votre MySQL à été créé avec ce workshop. Sinon à vous de voir.

> Je vous conseille d'utiliser Nginx sur le port 8000, car le port 80 proposé de base est très souvent déjà utilisé par Windows (attention, le port doit être libre, mais généralement ce port est toujours libre, à moins que vous ayez un autre projet qui tourne actuellement, au quel cas il faudra l'arrêter ou changer de port)
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
7. Démarrer les services dont vous avez besoins, dans la plus part des cas les services suivants sont suffisant pour commencer en tout cas. Vous pourrez toujours ajouter des services par la suite.
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
10. Créer votre projet Laravel
```sh
# Execute in workspace
composer create-project laravel/laravel my-project-name
```
11. Déplacer tout le contenu du dossier de projet Laravel qui vient d'être créé à la racine (optionnel, mais je recommande, car cela simplifie les commandes pour la suite)
12. Supprimer le dossier vide du projet Laravel
13. Modifier le `.env` pour correspondre à votre configuration, si toutes les étapes ont étées suivies voici se qu'il faudra modifier.
```sh
DB_HOST=mysql
DB_DATABASE=myprojectdbname
DB_USERNAME=homestead
DB_PASSWORD=secret
...
REDIS_HOST=redis
```
14. Créer la base de données pour votre projet
> Avec phpmyadmin (accessible depuis http://localhost:8081 normalement) vous pouvez le faire en suivant ce tuto : http://webvaultwiki.com.au/Create-Mysql-Database-User-Phpmyadmin.ashx (Attention il y a des différences avec le tuto, lisez la suite avant de suivre le tuto)  
> Attention il y 2 différences par rapport au tuto. Ne créez pas de nouvel utilisateur, attribuez la nouvelle BDD à "homestead" ou à l'utilisateur que vous souhaitez utiliser. Et donner tous les droits à cet utilisateurs sur la nouvelle BDD, pas simplement une partie comme indiquer dans le tuto.  
> Ces étapes devront être réalisées avec l'utilisateur root (mot de passe : root)
15. Installer les dépendances de base pour votre projet Laravel et démarrer les commandes de configurations de base.
```sh
# Execute in workspace
composer install
php artisan key:generate
php artisan migrate
```
16. Tester que tout fonctionne en accédant à http://localhost:8000, vous devriez avoir un page Laravel.
