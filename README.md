# Introduction

Workshop Laravel donné aux étudiants de 3ème année à la HE-Arc.

L'objectif de ce workshop est de fournir un point de départ aux étudiants afin de leur permettre de créer leur projet de semestre.

Les prochaines étapes vous permetteront de mettre en place votre environement de dévelopement et de suivre le workshop dans son intégralité.

# Prérequis

Commencez par télécharger et installer les éléments suivants en fonction de votre système.

Certaines étapes sont optionnelles, cela veut donc dire que vous pourrez suivre le workshop avec ou sans.

## Windows

### Docker Desktop
https://docs.docker.com/get-docker/

### WSL2 (optionnel)
- Installer WSL2 : https://docs.microsoft.com/en-us/windows/wsl/install-win10
- Lié Docker Desktop à WSL2 : https://docs.docker.com/desktop/windows/wsl/

**Problème avec VMWare ou autre**  
WSL2 n'est pas compatible avec d'autres outils de virtualisation comme VMWare ou autre.  
Pour utiliser cet outil il faut avoir activé Hyper-V sur Windows, voici comment faire si jamais cela est nécessaire pour vous :
```
Disable Hyper-V - Hyper-V has to be uninstalled to use VMWare
- Execute : bcdedit /set hypervisorlaunchtype off

Enable Hyper-V - Hyper-V has to be installed to use Docker
- Execute : bcdedit /set hypervisorlaunchtype auto
```
Source : https://www.ivobeerens.nl/2018/12/13/vmware-workstation-device-credential-guard-are-not-compatible/

### PHP
Installez la version **7.4** !
- WSL2 : Pour les personnes ayant installées WSL2, ouvrez un bash dans votre distribution Linux et suivez les étapes dans le chapitre "Linux --> PHP" de ce README
- PAS WSL2 : Pour les personnes n'ayant PAS installées WSL2, installez XAMPP qui contient PHP.  
  - Choisissez la version `7.4.23 / PHP 7.4.23` : https://www.apachefriends.org/download.html

### Composer
https://getcomposer.org/download/
- WSL2 : Pour les personnes ayant installées WSL2, suivez la partie "Command-line installation" sur le site

### Visual Studio Code (recommandé) ou un autre IDE
- VSCode : https://code.visualstudio.com/
- Remote Development (Obligatoire uniquement pour les personnes ayant installées WSL2) : https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.vscode-remote-extensionpack

## Linux

### Docker
- Docker : https://docs.docker.com/get-docker/
- Docker Compose : https://docs.docker.com/compose/install/

### PHP
Installer la version **7.4** !  
Voici les étapes à suivre :  
```bash
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php7.4
sudo apt-get install php7.4 php7.4-cli php7.4-common php7.4-json php7.4-opcache php7.4-mysql php7.4-mbstring php7.4-mcrypt php7.4-zip php7.4-fpm php7.4-xml
```
Source : https://www.techiediaries.com/install-laravel-8-php-7-3-composer/

### Composer
https://getcomposer.org/download/

### Visual Studio Code (recommandé) ou un autre IDE
- VSCode : https://code.visualstudio.com/

# Récupérer le projet

Ce repository contient des submodules veuillez utiliser la commande suivante :  
```bash
git clone --recursive [URL to Git repo]
```

Si vous avez oublié d'utiliser `--recursive`, executez cette commande après avoir cloné le projet :  
```bash
git submodule update --init laradock/
```

# Configurer le projet

Copiez le fichier `.env.example` situé dans le dossier `laradock` et renommez le `.env`.
Aller dans le dossier `laradock` et exécutez copier 
```bash
cd laradock
cp .env.example .env
```

Ouvrez le fichier `.env` fraichement créé et modifié les éléments suivants :
```bash
COMPOSE_PROJECT_NAME=workshop-laravel
...
MYSQL_DATABASE=workshop
MYSQL_USER=homestead
MYSQL_PASSWORD=secret
...
NGINX_HOST_HTTP_PORT=8000
```

Démarrez les containers Docker utile au projet (cela peut prendre quelques minutes la première fois, c'est normal).
```bash
docker-compose up nginx mysql phpmyadmin redis workspace
```

ou alors avec le paramètre `-d` pour ne pas bloqué la console.
```bash
docker-compose up -d nginx mysql phpmyadmin redis workspace
```

Copiez le fichier `.env.example` à la racine du projet et renommez le `.env`.
```bash
cd ..
cp .env.example .env
```
Le contenu de ce fichier n'est pas à modifier, car il déjà adapté à la configuration du projet.

Essayez d'accéder à l'url : http://localhost:8000

Si vous avez un résultat c'est que vous êtes normalement prêt à suivre le workshop :)

Si non, c'est terrible ! Commencez par faire 3 tours sur vous même ou un peu plus, c'est important.  
Assurez-vous de n'avoir rien oublié, regardez également avec vos camarades qui ont réussi.
