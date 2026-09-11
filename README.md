# Introduction

Workshop Laravel donné aux étudiants de 3ème année à la HE-Arc dans le cadre du cours de développement web.

L'objectif de ce workshop est de transmettre aux étudiants les bases et les bonnes pratiques de la création d'un projet web avec le Framework Laravel. Ce workshop a également pour but de fournir un point de départ aux étudiants afin de leur permettre de créer leur projet de semestre.

Les prochaines étapes permettent de mettre en place l'environnement de développement et de suivre le workshop dans son intégralité.

# Explication des branches

## Branches générales

- main : la branche contenant la version du README le plus à jour
- start : la branche contenant le code de départ du workshop Laravel

## Branches par année

- xxxx-main : la branche contenant la version du README le plus à jour, réalisé pour les étudiants de l'année xxxx
- xxxx-start : la branche contenant le code de départ du workshop Laravel, réalisé avec les étudiants de l'année xxxx

# Prérequis

Pour simplifier la configuration et la mise en place de l'environnement de dev nous allons utiliser laravel Herd qui est l'outil recomandé par laravel qui comprend PHP composer et les autres dépendances pour dev avec Laravel.

- **Windows** : [herd.laravel.com/windows](https://herd.laravel.com/windows)
- **macOS** : [herd.laravel.com](https://herd.laravel.com)
- **Linux** : Herd n'est pas disponible — suivez la
  [documentation officielle](https://laravel.com/docs/13.x/installation)

Sous Windows, lancez Herd **en tant qu'administrateur la première fois**, sinon l'installation ne se termine pas correctement. Autorisez également l'alerte du pare-feu Windows.

## Pièges sous Windows

**Utilisez PowerShell, pas Git Bash**, pour les commandes `php`, `composer`, `laravel` et `php artisan`.

**Si XAMPP, WAMP ou MAMP est installé**, son PHP peut masquer celui de Herd. Le
symptôme est trompeur : tout semble fonctionner, mais vous travaillez avec une
version de PHP trop ancienne. Vérifiez avec `php --version` — si ce n'est pas
8.4.x, retirez le dossier `php` de l'installation concernée de votre PATH.

Si VS Code était déjà ouvert, **fermez-le et relancez-le entièrement** après l'installation. Ouvrir un nouveau terminal ne suffit pas : VS Code conserve l'environnement qu'il avait au démarrage et ne verra pas Herd.

Pour vérifier que tout est bien configuré :

`php --version` PHP 8.4.x

`composer --version` Composer version 2.x

Vous pouvez choisir d'**utiliser d'autres outils** que ceux indiqués en dessous, mais **le support ne vous sera pas garanti si vous rencontrez des problèmes**.  
Gardez en tête que le workshop a été conçu en utilisant les prérequis recommandés en dessus.  
Si vous souhaitez utiliser d'autres outils, voici ce qu'il vous faut au minimum :

- Un serveur web : PHP built-in server, Apache, Nginx, ...
- Un système de base de données : MySQL, PostgreSQL, ...
- PHP version >= 8.3.x
- Composer version compatible avec la version de PHP installée
- Un IDE : VS Code (recommandé), PhpStorm ou autre
- Git : Une version assez récente devrait suffire
- Suivez les prochains chapitres afin de vous assurer de pouvoir suivre le workshop

> Si Docker vous intéresse, vous pouvez utiliser Laradock. C'est un très bon outil vous fournissant des conteneurs Docker de base pour travailler avec Laravel et Docker.

> Pour information également, Laravel met à disposition un environnement de développement docker qui s'appel Sail (https://laravel.com/docs/13.x/sail)

> En pratique il y a de fortes chances pour que vous soyez amené à utiliser Docker à l'avenir. Mais le workshop se concentre sur Laravel, nous allons donc peu ou pas aborder Docker.

# Récupérer le projet

Récupérez le projet en SSH. Sur GitHub appuyez sur le bouton vert `Code` en haut à droite et sélectionnez SSH.

![image](https://user-images.githubusercontent.com/39899628/189638725-1f41f029-20ed-433a-b853-2be9ff92f0c2.png)

> **Important** : Si vous récupérez le projet via SSH, il faudra générer une clé SSH sur votre machine si cela n'est pas déjà fait : [Generating a new SSH key](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent#generating-a-new-ssh-key)

> Et configurer la clé publique sur GitHub : [About addition of SSH keys to your account](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/adding-a-new-ssh-key-to-your-github-account)

```bash
git clone [SSH URL]
```

# Configurer le projet

Déplacez-vous sur la branche `xxxx-start` en remplaçant `xxxx` par l'année actuelle.

> Si nous sommes en 2026, la bonne branche sera `2026-start`

```bash
git checkout [nom de la branche]
```

Faites une copie du fichier `.env.example` à la racine du projet et renommez-le `.env`.

```bash
# Execute in project root
cp .env.example .env
```

> Le contenu de ce fichier n'est pas à modifier, car il il est déjà configuré pour
> SQLite, qui ne demande aucune installation ni aucun serveur.
> Si vous aviez déjà une base de données installée, il faudra peut être adapté ce fichier quand même.
> Notamment les paramètres `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` et/ou d'autres dépendants de votre configuration locale.

Installez les dépendances et préparez la base de données :

```bash
# Execute in workspace bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

> À la commande `migrate`, Laravel vous demandera :
> `The SQLite database configured for this application does not exist. Would you like to create it?`
> Répondez **Yes** : le fichier `database/database.sqlite` sera créé
> automatiquement, puis les tables et les données de test.

Démarrez le serveur de développement fourni par PHP.

```bash
php artisan serve
```

# Tester que tout fonctionne

Essayez d'accéder à l'URL : http://localhost:8000

Vous devriez avoir une page avec marquée "You are READY for the workshop ;)", sinon regardez dans les logs pour comprendre ce qui n'a pas fonctionné.

Si vous avez le résultat demandé, c'est que vous êtes normalement prêt à suivre le workshop :)

Sinon, assurez-vous de n'avoir oublié aucune des étapes et regardez également avec vos camarades qui pourraient également vous aider. Si toujours pas, on regardera ensemble lors du premier cours après la partie théorique.


---

**La préparation du workshop s'arrête ici !**

Les points suivants vous seront utiles lorsque vous créerez votre propre projet.

Ils ne sont pas utiles pour la préparation au workshop !

---

# Comment initialiser un nouveau projet avec Laravel

La documentation de Laravel est très complète et permet de démarrer un nouveau projet en un rien de temps.

https://laravel.com/docs/13.x/installation#your-first-laravel-project
