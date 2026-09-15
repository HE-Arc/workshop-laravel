<!-- TODO-1-3 Créer une vue blade "home.blade.php" dans "resources/views" avec "Hello World - view!" affiché -->
<!-- TODO-1-4 Renvoyer la vue dans le contrôleur et tester d'accéder à "/" -->

<!-- TODO-2-0 Ajouter le contenu de la nouvelle vue "home" (voir examples/2-0-layout.html) et
    ajouter le lien vers la vue "home" dans la navbar -->

<!-- TODO-4-3 Créer une vue blade layout permettant de fournir une base pour les autres vues "views/layout/app.blade.php" -->
<!-- TODO-4-4 Utiliser le contenu de la vue "home" pour la vue layout -->
<!-- TODO-4-5 Adapter légèrement la vue layout en utilisant la directive blade @ yield("content") -->
<!-- TODO-4-6 Adapter la vue "home" pour utiliser le layout app @ extends("layout.app") et
    créer une section @ section("content") + @ endsection -->
<!-- TODO-4-7 Créer la vue "books.blade.php" pour afficher les books en utilisant le layout app et @ foreach-->
<!-- TODO-4-8 Améliorer la vue books pour afficher les livres dans un tableau (voir examples/4-8-books-index.html) -->
<!-- TODO-4-9 Ajouter le lien à la vue books dans "layout.app" -->

<!-- TODO-5-0 Créer un dossier "books" dans "views" afin de regrouper les vues -->
<!-- TODO-5-1 Renommer la vue "books" en "index" (attention à adapter le contrôleur) -->
<!-- TODO-5-2 Créer les vues manquantes afin de compléter le CRUD de "books" (create, edit, index, show) et
    y inscrire quelque chose de temporaire -->
<!-- TODO-5-4 Ajouter des boutons d'actions dans la vue "index"
    Ajouter un livre:
    <a href="TODO route Laravel" class="btn btn-primary float-end mb-2">Ajouter un livre</a>
    Afficher:
    <a class="btn btn-info" href="TODO route Laravel">Afficher</a>
    Modifier:
    <a class="btn btn-primary" href="TODO route Laravel">Modifier</a>
    Supprimer:
    <form action="TODO route Laravel" method="POST">
        @ csrf
        @ method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
-->
<!-- TODO-5-7 Réceptionner et afficher les message de confirmations et tester le bouton "delete"
    1. Modifier "app.blade.php"
    2. Accéder aux message via Session::get("...") et l'afficher dans le div "container" au dessus du "yield content"
    3. Utiliser les alert bootstrap pour faire quelque de plus esthétique
-->
<!-- TODO-5-8 Créer le formulaire de création
    - Récupérer le template fourni et compléter les TODOs (voir examples/5-8-books-create.html)
    - Tester l'ajout d'un livre (ne fonctionne pas ? c'est normal.)
    - Résoudre le problème du "mass assignement" empêchant de créer un livre
-->
<!-- TODO-5-9 Créer le formulaire d'édition
    - Récupérer le template fourni et compléter les TODOs (voir examples/5-9-books-edit.html)
    - Tester l'édition d'un livre
-->
<!-- TODO-5-10 Compléter la vue permettant d'afficher les détails d'un livre
    - Récupérer le template fourni et compléter les TODOs (voir examples/5-10-books-show.html)
    - Tester l'affichage d'un livre
-->

<!-- TODO-6-1 Tester d'afficher les erreurs sur la vue de création en utilisant "$errors" -->
<!-- TODO-6-2 Améliorer l'affichage des erreurs à l'aide d'une liste HTML et des classes alert
    de Bootstrap à placer en dessous du bouton
-->
<!-- TODO-6-4 Afficher les boutons et liens de paginations sur la vue "index" -->

<!-- TODO-7-0 Créer une vue "order.blade.php" permettant de lister les livres à commandés
    - Repartir de la vue "index" (garder la pagination)
    - Afficher tous les livres reçu sur cette page (la logique de filtre sera faites dans le contrôleur)
-->
<!-- TODO-7-3 Ajouter le lien à la vue order dans "layout.app" -->
<!-- TODO-7-4 Afficher un message spécial si aucun livre ne doit être commandé -->

<!-- TODO-8-7 Afficher l'ID des auteurs sur la page index de "Book" (si pas d'auteur, afficher un message pour l'indiquer) -->
<!-- TODO-8-8 Créer 3 auteurs et les attribuer à des livres avec "php artisan tinker" , lancer tinker et créer 3 auteurs (ça ne fonctionne pas ? souvenez-vous du TODO-5-8),
    attribuer un auteur à quelques livres (en laisser au moins un sans auteur) et tester pour voir si tout fonctionne
-->
<!-- TODO-8-9 Afficher le nom des auteurs et pas seulement leur ID en modifiant la méthode "index" de "BookController" -->
<!-- TODO-8-11 Ajout un champs de type "select" sur la page de création
    et afficher les auteurs (attention name de select doit contenir author_id) -->
<!-- TODO-8-12 Améliorer le formulaire pour conserver les saisies utilisateur en cas d'erreur du formulaire -->

<!-- TODO-9-0 Importer les icones bootstrap via un CDN dans "layout.app" : https://icons.getbootstrap.com/#install -->
<!-- TODO-9-1 Ajouter des icones aux endroits pertinent sur l'app : https://icons.getbootstrap.com/ -->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Workshop Laravel — HE-Arc</title>
</head>
<body style="font-family: roboto, sans-serif; margin: 2rem;">
    <h1>Workshop Laravel — HE-Arc</h1>
    @if (count($users) > 0)
        <h1 style="color: rgb(7, 218, 7)">You are READY for the workshop ;)</h1>
        <p>{{ count($users) }}: users, test si db seed.</p>
    @else
        <h1 style="color: red">You are NOT ready for the workshop :( pas de user dans la db</h1>
        <p>Avez-vous exécuté <code>php artisan migrate --seed</code> ?</p>
    @endif

    <p style="color: #666; margin-top: 2rem;">
        Version de Laravel {{ Illuminate\Foundation\Application::VERSION }} et PHP {{ PHP_VERSION }}
    </p>
</body>
</html>
