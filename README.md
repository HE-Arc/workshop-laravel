# Introduction

Workshop Laravel donné aux étudiants de 3ème année à la HE-Arc.

L'objectif de ce workshop est de transmettre aux étudiants les bases et les bonnes pratique de la création d'un projet web avec le Framework Laravel. Ce workshop à également comme but de fournir un point de départ aux étudiants afin de leur permettre de créer leur projet de semestre.

Les prochaines étapes permettent de mettre en place l'environement de dévelopement et de suivre le workshop dans son intégralité.

# Prérequis

Commencez par télécharger et installer les éléments suivants en fonction de votre système.

## Windows

### Docker Desktop
https://docs.docker.com/get-docker/

**IMPORTANT**
- Il est important de lire et compléter la section **"System requirements"**, il est également fortement recommandé de lire et suivre tous les autres chapitres de cette page afin de s'assurer de l'installer correctement sur votre système.
- Il est possible de choisir entre "WSL 2 Backend" ou "Hyper-V backend", les 2 options sont viables pour pouvoir suivre le workshop.

> WSL 2 = Windows Subsystem for Linux  
> Cela vous permet d'avoir une distribution Linux sur votre machine.  
> Documentez-vous un peu sur WSL 2 pour en savoir plus.  

Si vous n'avez pas installer WSL 2 et que Docker Desktop vous affiche une erreur ou il est marqué que WSL doit être activé ou quelque chose dans le genre.
Allez voir dans `C:\Users\<username>\AppData\Roaming\Docker\settings.json` et modifiez `wslEngineEnabled` à `false`.
Redémarrez Docker Desktop et voyez si le problème à disparu --> Clique droit sur l'icone Docker Desktop en bas à droite, puis "Restart Docker..."
Source : https://github.com/docker/for-win/issues/6122

### Visual Studio Code (recommandé) ou un autre IDE
- VSCode : https://code.visualstudio.com/
- WSL 2 : Si vous avez installer WSL 2, installez l'extention VSCode "Remote Development" téléchargeable ici ou directement sur VSCode : https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.vscode-remote-extensionpack

## Linux

### Docker
- Docker : https://docs.docker.com/get-docker/
- Docker Compose : https://docs.docker.com/compose/install/

### Visual Studio Code (recommandé) ou un autre IDE
- VSCode : https://code.visualstudio.com/

# Récupérer le projet

Ce repository contient des submodules veuillez utiliser la commande suivante :  
```bash
git clone --recursive [URL to Git repo]
```

Si vous avez oublié d'utiliser `--recursive` dans la commande précédente, executez cette commande après avoir cloné le projet :  
```bash
git submodule update --init laradock/
```

# Configurer le projet

Créez une copie du fichier `.env.example` situé dans le dossier `laradock` et renommez le `.env`.  
```bash
# Execute in laradock
cp .env.example .env
```

Ouvrez le fichier `.env` fraichement créé et modifié les éléments suivants :
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

Démarrez les containers Docker utile au projet (cela peut prendre quelques minutes la première fois, c'est normal).
```bash
# Execute in laradock
docker-compose up nginx mysql phpmyadmin redis workspace
```

ou alors avec le paramètre `-d` pour ne pas bloqué la console.
```bash
# Execute in laradock
docker-compose up -d nginx mysql phpmyadmin redis workspace
```

Copiez le fichier `.env.example` à la racine du projet et renommez le `.env`.
```bash
# Execute in project root
cp .env.example .env
```
Le contenu de ce fichier n'est pas à modifier, car il déjà adapté à la configuration du projet.
> Si vous avez déjà utilisé "Laradock", adaptez les variables `DB_USERNAME` et `DB_PASSWORD` dans le fichier `.env` situé à la racine du projet. Adaptez également  les variables `MYSQL_USER` et `MYSQL_PASSWORD` dans le fichier `.env` situé dans le dossier `laradock`. Cela vous permettra de vous connecter à votre système de base de données existant.

Connectez vous au container docker `workspace`, installez les dépendances et mettez le projet Laravel en place.
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

Essayez d'accéder à l'url : http://localhost:8000

Vous devriez avoir une page avec marqué "You are READY for the workshop ;)", sinon regardez dans les logs des différents containers Docker que vous avez exécuté pour comprendre se qui n'a pas fonctionné.
> Astuce : si vous avez démarrés vos containers avec le paramètre `-d`, vous pouvez ouvrir Docker Desktop et cliquer sur les containers pour voir les logs de ce dernier. Ou alors ouvrir un bash dans le dossier `laradock` et exécuter `docker-compose logs <nom_du_service>` (<nom_du_service> peut dans notre cas être l'un des éléments suivants : nginx mysql phpmyadmin redis workspace).

Si vous avez le résultat demandé, c'est que vous êtes normalement prêt à suivre le workshop :)

Si non, c'est terrible ! Commencez par faire 3 tours sur vous même ou un peu plus.  
Ensuite assurez-vous de n'avoir oublié aucune des étapes et regardez également avec vos camarades qui pourraient vous aider.
