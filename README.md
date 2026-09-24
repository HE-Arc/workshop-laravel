# Configuration du workshop

La documentation de configuration du workshop se trouve dans le README sur la branche `main`.

Ce README sera utile durant la réalisation du workshop.

# Réponses

**ATTENTION**  
Ce README a été conçu pour être visualisé en mode "preview", depuis GitHub ou depuis n'importe quel autre interpréteur MarkDown.  
Si vous ouvrez et suivez les instructions de ce fichier dans votre IDE, vous pourriez avoir quelques soucis avec le copier-coller, etc.

**AVERTISSEMENT**  
Lire les réponses uniquement en cas de besoins, essayez d'abords par vous-même, vous apprendrez mieux ;)

> Dans les énoncés, les directives Blade sont écrites avec une espace — `@ yield`,
> `@ extends`, `@ csrf` — pour éviter que Blade ne les interprète dans les
> commentaires. **Retirez cette espace** quand vous les écrivez : `@yield`.

TODO-0-0

TODO-1-0

`php artisan make:controller HomeController`

> `php artisan` permet de voir les actions possible avec l'outil artisan

TODO-1-1

```php
public function index() {
    return response("Hello world!");
}
```

TODO-1-2

```php
Route::get('/', [HomeController::class, 'index'])->name('home');
```

TODO-1-3

- Créer la vue blade `home.blade.php`
- Écrire le texte sur la vue

TODO-1-4

Modifier le controleur pour renvoyer la vue

```php
public function index() {
    return view('home');
}
```

TODO-2-0

> Les CDN sont utils pour des tests, mais à éviter en prod

> Pour créer le "DOCTYPE html" dans VSCode il suffit d'écrire `!` dans la vue pour créer un template HTML de base.

TODO-3-0

`php artisan make:model Book`

TODO-3-1

`php artisan make:migration create_books_table`

TODO-3-2

```php
Schema::create('books', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->integer('pages')->unsigned();
    $table->integer('quantity')->unsigned();

    $table->timestamps();
});
```

TODO-3-3

`php artisan migrate`

> Une migration déjà push sur git ne doit jamais être modifiée ! Il faut en créer une nouvelle et effectuer les modifications dans la nouvelle. Pourquoi cette règle...?  
> C'est en fait pour vous habituer et vous protéger. Théoriquement et techniquement c'est tout à fait possible et Laravel ne vous y empêchera pas...  
> **MAIS** si vous le faîtes vos autres collègues et vos déploiement (serveur, etc.) seront affectés. En pratique, si cela est mal réalisé, cela peut avoir des conséquences embêtantes pour vos collègues et desastreuses pour vos déploiements. Comme la perte de vos données dans les pires cas...  
> Cela est également à évité pour d'autres raisons, comme le fait que vous perdiez l'historique de vos migrations (l'évolutions de votre BDD), ce qui peut être pratique pour comprendre pourquoi et comment certains changements ont été effectués. Bref. Ne le faites pas, ou alors ayez un excellente raison !

> Il est possible d'annuler une migration dans la base de donnée avec `php artisan migrate:rollback` (annule le dernier "batch" de migrations) ou avec `php artisan migrate:rollback --step=5` (step = nombre de migrations rollback) ou encore `php artisan migrate:reset` (annule toutes les migrations)

> Il est également possible d'annuler toutes les migrations et de les réaffecter à nouveau toutes : `php artisan migrate:refresh` (avec `--seed` pour exécuter les seeders également)

TODO-3-4

`php artisan make:seeder BookSeeder`

TODO-3-5

```php
\App\Models\Book::truncate();

$books = [
    ['title' => 'Assassins Apprentice', 'pages' => 110, 'quantity' => 1],
    ['title' => 'Assassins Apprentice 2', 'pages' => 110, 'quantity' => 1],
    ['title' => 'The Hobbit', 'pages' => 245, 'quantity' => 10],
    ['title' => 'Nineteen Eighty-Four', 'pages' => 123, 'quantity' => 11],
    ['title' => 'The Black Prism', 'pages' => 345, 'quantity' => 0]
];

foreach ($books as $book){
    \App\Models\Book::create(array(
        'title' => $book["title"],
        'pages' => $book["pages"],
        'quantity' => $book["quantity"]
    ));
}
```

TODO-3-6

```php
$this->call(BookSeeder::class);
```

TODO-3-7

`php artisan db:seed`

TODO-4-0

`php artisan make:controller BookController --resource`

TODO-4-1

```php
$books = \App\Models\Book::all();
return view('books', ['books' => $books]);
```

TODO-4-2

```php
Route::resource('books', BookController::class);
```

TODO-4-3

TODO-4-4

TODO-4-5

```html
<div class="container mt-3">@yield('content')</div>
```

TODO-4-6

```html
@extends('layout.app') @section('content')
<h1>Library App</h1>
<p class="lead">Hello World</p>
@endsection
```

### TODO-4-7 — Afficher les livres dans une vue

**Fichier :** `resources/views/books.blade.php` (à créer)

Le contrôleur envoie la variable `$books` (TODO-4-1), la vue la parcour avec `@foreach` :

```blade
@extends('layout.app')

@section('content')
    @foreach ($books as $book)
        {{ $book }}
    @endforeach
@endsection
```

> À ce stade `{{ $book }}` affiche l'objet complet en JSON : c'est volontairement moche,
> on l'améliore au TODO suivant. Le but ici est juste de vérifier que les données arrivent
> bien du contrôleur jusqu'à la vue.

---

### TODO-4-8 — Mettre les livres dans un tableau

**Fichier :** `resources/views/books.blade.php`  
**Où :** remplacer le contenu de la section par le template `examples/4-8-books-index.html`, puis rendre le `<tr>` dynamique.

Le `@foreach` entoure **le `<tr>`, pas le `<table>`** — sinon tu obtiens un tableau complet par livre :

```blade
@extends('layout.app')

@section('content')
    <h1>Livres</h1>

    <a href="#" class="btn btn-primary mb-2">Ajouter un livre</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Pages</th>
                <th scope="col">Quantité</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->pages }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>--actions--</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
```

---

### TODO-4-9 — Lien « Books » dans la navbar

**Fichier :** `resources/views/layout/app.blade.php`  
**Où :** dans le `<li class="nav-item">` de la navbar, remplacer le `href` provisoire.

```blade
<a class="nav-link" href="{{ route('books.index') }}">Books</a>
```

> **Pourquoi `route()` et pas `/books` ?** Si le nom de la ressource change un jour, toutes les
> URL de l'app suivent automatiquement. Avec des URL écrites en dur, il faudrait corriger chaque lien.

---

### TODO-5-0 — Regrouper les vues dans un dossier

**Action :** créer le dossier `resources/views/books/` et y déplacer `books.blade.php`.

Rien à écrire, c'est uniquement de l'organisation de fichiers. Le point dans `view('books.index')`
correspond au `/` du chemin : `books/index.blade.php` → `books.index`.

---

### TODO-5-1 — Renommer la vue en `index`

**Fichiers :** `resources/views/books/index.blade.php` (renommage) et `app/Http/Controllers/BookController.php`

Après le renommage, la vue s'appelle `books.index`. Adapter la méthode `index` :

```php
public function index()
{
    $books = \App\Models\Book::all();
    return view('books.index', ['books' => $books]);
}
```

> Si tu oublies le contrôleur : `View [books] not found`.

---

### TODO-5-2 — Créer les vues manquantes du CRUD

**Fichiers à créer dans `resources/views/books/` :** `create.blade.php`, `edit.blade.php`, `show.blade.php`

Dans chacune, du contenu provisoire pour vérifier le routage :

```blade
@extends('layout.app')

@section('content')
    <h1>Création d'un livre</h1>   {{-- puis "Édition", "Détails" dans les deux autres --}}
@endsection
```

---

### TODO-5-3 — Relier les vues aux méthodes du contrôleur

**Fichier :** `app/Http/Controllers/BookController.php`

```php
public function create()
{
    return view('books.create');
}

public function show(string $id)
{
    return view('books.show');
}

public function edit(string $id)
{
    return view('books.edit');
}
```

Tester ensuite chaque URL à la main : `/books/create`, `/books/1`, `/books/1/edit`.

---

### TODO-5-4 — Boutons d'action dans la liste

**Fichier :** `resources/views/books/index.blade.php`

Bouton « Ajouter », au-dessus du tableau :

```blade
<a href="{{ route('books.create') }}" class="btn btn-primary float-end mb-2">Ajouter un livre</a>
```

Colonne actions, **à l'intérieur du `@foreach`** (c'est `$book->id` qui change à chaque ligne) :

```blade
<td>
    <a class="btn btn-info" href="{{ route('books.show', $book->id) }}">Afficher</a>
    <a class="btn btn-primary" href="{{ route('books.edit', $book->id) }}">Modifier</a>

    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</td>
```

> **Pourquoi un `<form>` pour supprimer et un `<a>` pour le reste ?** Un lien envoie toujours un GET.
> La suppression exige un DELETE, impossible avec un `<a>`.
>
> **`@csrf`** insère un jeton caché : sans lui, Laravel refuse le POST avec une erreur 419.
>
> **`@method('DELETE')`** insère un champ caché `_method=DELETE`. Le navigateur envoie un POST,
> Laravel lit ce champ et route vers `destroy()`. C'est le _method spoofing_.

---

### TODO-5-5 — Compléter les méthodes du contrôleur

**Fichier :** `app/Http/Controllers/BookController.php`

```php
public function store(Request $request)
{
    \App\Models\Book::create($request->all());

    return redirect()->route('books.index');
}

public function show(string $id)
{
    $book = \App\Models\Book::findOrFail($id);
    return view('books.show', ['book' => $book]);
}

public function edit(string $id)
{
    $book = \App\Models\Book::where('id', $id)->firstOrFail();
    return view('books.edit', ['book' => $book]);
}

public function update(Request $request, string $id)
{
    \App\Models\Book::findOrFail($id)->update($request->all());

    return redirect()->route('books.index');
}

public function destroy(string $id)
{
    $book = \App\Models\Book::find($id);
    $book->delete();

    return redirect()->route('books.index');
}
```

> **Pourquoi `redirect()` et pas `view()` après un POST ?** Si on renvoyait une vue directement,
> un F5 du navigateur renverrait le formulaire et créerait un doublon. La redirection repart
> sur un GET propre.
>
> **`findOrFail` vs `find`** : `findOrFail` renvoie une 404 si l'ID n'existe pas, `find` renvoie
> `null` et plante ensuite sur `->delete()`.
>
> Laravel peut aussi faire la conversion ID → objet tout seul (_route model binding_) :
>
> ```php
> public function show(Book $book)
> {
>     return view('books.show', compact('book'));
> }
> ```

---

### TODO-5-6 — Messages de confirmation (envoi)

**Fichier :** `app/Http/Controllers/BookController.php`  
**Où :** enchaîner `->with(...)` sur les trois redirections de `store`, `update` et `destroy`.

```php
// store()
return redirect()->route('books.index')
    ->with('success', 'Book created successfully.');

// update()
return redirect()->route('books.index')
    ->with('success', 'Book updated successfully.');

// destroy()
return redirect()->route('books.index')
    ->with('success', 'Book deleted successfully.');
```

> `with()` stocke le message en session **pour la requête suivante uniquement** (_flash data_) :
> il s'affiche une fois puis disparaît tout seul.

---

### TODO-5-7 — Messages de confirmation (affichage)

**Fichier :** `resources/views/layout/app.blade.php`  
**Où :** dans le `<div class="container">`, **au-dessus** du `@yield('content')`.

En le plaçant dans le layout, le message s'affiche sur n'importe quelle page sans rien dupliquer.

Version minimale :

```blade
<div class="container mt-3">
    @if (session('success'))
        {{ session('success') }}
    @endif

    @yield('content')
</div>
```

Version avec une alerte Bootstrap :

```blade
<div class="container mt-3">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @yield('content')
</div>
```

> `$message = Session::get('success')` fait deux choses d'un coup : l'affectation renvoie la valeur,
> que le `@if` teste ensuite. `@if (session('success'))` est plus lisible si cette syntaxe te gêne.

---

### TODO-5-8 — Formulaire de création

**Fichier :** `resources/views/books/create.blade.php`  
**Template de départ :** `examples/5-8-books-create.html`

Chaque marqueur `TODO` du template correspond à une ligne précise :

| Marqueur dans le template                    | À remplacer par                       |
| -------------------------------------------- | ------------------------------------- |
| `TODO: extends app layout` (ligne 1)         | `@extends('layout.app')`              |
| `TODO: section content` (ligne 1)            | `@section('content')`                 |
| `href="TODO: route Laravel"` (bouton Retour) | `href="{{ route('books.index') }}"`   |
| `action="TODO: route Laravel"` (`<form>`)    | `action="{{ route('books.store') }}"` |
| `TODO: CSRF` (dans le `<form>`)              | `@csrf`                               |
| `TODO: end section content` (dernière ligne) | `@endsection`                         |

Soit, une fois complété (le corps du formulaire est inchangé) :

```blade
@extends('layout.app')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <a class="btn btn-primary" href="{{ route('books.index') }}">Retour</a>
        </div>
    </div>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        {{-- ... les champs title / pages / quantity du template ... --}}
    </form>
@endsection
```

#### Le problème du _mass assignment_

Le formulaire est correct, mais l'ajout échoue quand même. C'est normal, et c'est une **sécurité**
de Laravel : `Book::create($request->all())` écrirait dans la base _tous_ les champs envoyés par le
navigateur. Un utilisateur malveillant pourrait ajouter un champ à la main (`is_admin`, `price`, ...)
et modifier des colonnes qu'on n'avait jamais prévu d'exposer. Laravel bloque donc tout par défaut.

Deux solutions :

**1. Lister les champs à la main** dans `BookController::store` :

```php
$book = new \App\Models\Book();
$book->title    = $request->title;
$book->pages    = $request->pages;
$book->quantity = $request->quantity;
$book->save();
```

**2. Déclarer les champs autorisés** dans `app/Models/Book.php`, et garder `Book::create()` :

```php
protected $fillable = [
    'title', 'pages', 'quantity',
];
```

> La solution 2 est la plus courante. Il existe aussi `$guarded`, qui fait l'inverse (lister
> les champs interdits) — déconseillé, car tout nouveau champ devient exposé par défaut.

---

### TODO-5-9 — Formulaire d'édition

**Fichier :** `resources/views/books/edit.blade.php`  
**Template de départ :** `examples/5-9-books-edit.html`

| Marqueur dans le template                 | À remplacer par                                     |
| ----------------------------------------- | --------------------------------------------------- |
| `TODO TODO` (ligne 1)                     | `@extends('layout.app')` puis `@section('content')` |
| `href="TODO"` (bouton Retour)             | `href="{{ route('books.index') }}"`                 |
| `action="TODO: send the current book id"` | `action="{{ route('books.update', $book->id) }}"`   |
| `TODO TODO` (dans le `<form>`)            | `@csrf` puis `@method('PUT')`                       |
| `value="TODO"` (champ titre)              | `value="{{ $book->title }}"`                        |
| `value="TODO"` (champ pages)              | `value="{{ $book->pages }}"`                        |
| `value="TODO"` (champ quantité)           | `value="{{ $book->quantity }}"`                     |
| `TODO` (dernière ligne)                   | `@endsection`                                       |

```blade
@extends('layout.app')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <a class="btn btn-primary" href="{{ route('books.index') }}">Retour</a>
        </div>
    </div>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- les champs, pré-remplis avec value="{{ $book->... }}" --}}
    </form>
@endsection
```

> **Deux différences avec le formulaire de création**, et ce sont les deux pièges habituels :
>
> 1. `route('books.update', $book->id)` prend un **second argument** : sans lui, Laravel ne sait
>    pas quel livre modifier (`Missing required parameter`).
> 2. `@method('PUT')` est obligatoire. Sans lui, le POST part sur `store()` et **crée** un
>    nouveau livre au lieu de modifier l'existant.
>
> Le `value="{{ ... }}"` est ce qui pré-remplit les champs : c'est l'objet `$book` envoyé
> par la méthode `edit()` du contrôleur (TODO-5-5).

---

### TODO-5-10 — Vue de détail

**Fichier :** `resources/views/books/show.blade.php`  
**Template de départ :** `examples/5-10-books-show.html`

| Marqueur dans le template            | À remplacer par                                     |
| ------------------------------------ | --------------------------------------------------- |
| `TODO TODO` (ligne 1)                | `@extends('layout.app')` puis `@section('content')` |
| `href="TODO"` (bouton Retour)        | `href="{{ route('books.index') }}"`                 |
| `TODO` (après « Titre : »)           | `{{ $book->title }}`                                |
| `TODO` (après « Nombre de pages : ») | `{{ $book->pages }}`                                |
| `TODO` (après « Quantité : »)        | `{{ $book->quantity }}`                             |
| `TODO` (dernière ligne)              | `@endsection`                                       |

Pas de formulaire ici : la page ne fait qu'afficher, donc ni `@csrf` ni `@method`.

---

### TODO-6-0 — Valider les données

**Fichier :** `app/Http/Controllers/BookController.php`  
**Où :** au tout début de `store()`, **avant** la création du livre.

```php
$request->validate([
    'title'    => 'required|min:6|max:25',
    'pages'    => 'required|integer|gt:0|lt:1000',
    'quantity' => 'required|integer|gte:0|lt:100',
]);
```

> Si une règle échoue, Laravel **interrompt la méthode**, renvoie l'utilisateur sur le formulaire
> et place les messages dans une variable `$errors` disponible dans toutes les vues.
> Rien à attraper avec un `try/catch` : tout est automatique.

---

### TODO-6-1 — Voir les erreurs

**Fichier :** `resources/views/books/create.blade.php`

Pour commencer, afficher la variable brute afin de vérifier qu'elle se remplit :

```blade
{{ $errors }}
```

> `$errors` existe dans **toutes** les vues, même quand il n'y a aucune erreur (c'est alors
> un sac vide). Pas besoin de l'envoyer depuis le contrôleur.

---

### TODO-6-2 — Afficher les erreurs proprement

**Fichier :** `resources/views/books/create.blade.php`  
**Où :** sous le bouton d'envoi.

```blade
@if ($errors->any())
    <div class="alert alert-danger mt-3 col-12">
        <strong>Whoops!</strong> Il y a un problème avec vos entrées.<br /><br />
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

---

### TODO-6-3 — Paginer la liste

**Fichier :** `app/Http/Controllers/BookController.php`  
**Où :** méthode `index()`.

```php
$books = \App\Models\Book::latest()->paginate(5);

return view('books.index', compact('books'))
    ->with('i', (request()->input('page', 1) - 1) * 5);
```

> `paginate(5)` remplace `all()` : Laravel ne récupère plus que 5 livres et lit le numéro de page
> dans l'URL (`/books?page=2`). La variable `i` sert uniquement à numéroter les lignes en continu
> d'une page à l'autre.

---

### TODO-6-4 — Liens de pagination

**Fichier :** `resources/views/books/index.blade.php`  
**Où :** juste après `</table>`.

```blade
{!! $books->links() !!}
```

> **`{!! !!}` et non `{{ }}`** : `{{ }}` échappe le HTML et afficherait le code des boutons
> en texte brut. `{!! !!}` l'insère tel quel. À n'utiliser que sur du HTML de confiance —
> jamais sur une saisie utilisateur.

---

### TODO-6-5 — Adapter la pagination à Bootstrap

**Fichier :** `app/Providers/AppServiceProvider.php`

Par défaut, les liens générés par Laravel sont stylés pour Tailwind CSS. Le workshop utilise
Bootstrap, d'où des boutons qui s'affichent tout cassés. Laravel fournit le correctif :

```php
use Illuminate\Pagination\Paginator;   // en haut du fichier

public function boot(): void
{
    Paginator::useBootstrapFive();
}
```

> `useBootstrapFour()` et `useBootstrapThree()` existent aussi. `useBootstrap()` correspond
> à Bootstrap 4, pas à la version 5.

---

### TODO-7-0 — Vue des livres à commander

**Fichier :** `resources/views/books/order.blade.php` (à créer)

Partir d'une copie de `index.blade.php`, puis :

- modifier le titre en « Livres à commander » ;
- remplacer le bouton « Ajouter un livre » par un bouton « Retour aux livres » ;
- supprimer la colonne des boutons d'action (on ne modifie rien depuis cette page) ;
- garder le `{!! $books->links() !!}`.

```blade
@extends('layout.app')

@section('content')
    <h1>Livres à commander</h1>

    <a href="{{ route('books.index') }}" class="btn btn-primary mb-2">Retour aux livres</a>

    {{-- le tableau, sans la colonne Actions --}}

    {!! $books->links() !!}
@endsection
```

---

### TODO-7-1 — Route `order`

**Fichier :** `routes/web.php`

```php
Route::get('books/order', [BookController::class, 'order'])->name('books.order');
```

> **⚠️ Cette ligne doit être placée AVANT `Route::resource('books', ...)`.**
>
> Laravel teste les routes dans l'ordre du fichier et s'arrête à la première qui correspond.
> Si la ressource vient en premier, `/books/order` est capturé par `books/{book}` : Laravel
> cherche alors le livre dont l'ID est « order », ne le trouve pas, et renvoie une 404.

---

### TODO-7-2 — Méthode `order`

**Fichier :** `app/Http/Controllers/BookController.php`

```php
public function order()
{
    $books = \App\Models\Book::latest()->where('quantity', '<=', 0)->paginate(5);

    return view('books.order', compact('books'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
}
```

> C'est `index()` avec un `where()` en plus. Le filtre est dans le contrôleur, pas dans la vue :
> la vue affiche ce qu'on lui donne, elle ne décide pas ce qui mérite d'être commandé.

---

### TODO-7-3 — Lien « Order » dans la navbar

**Fichier :** `resources/views/layout/app.blade.php`

```blade
<a class="nav-link" href="{{ route('books.order') }}">Order</a>
```

---

### TODO-7-4 — Message quand la liste est vide

**Fichier :** `resources/views/books/order.blade.php`

Avec un `@if` autour de la boucle :

```blade
@if ($books->count() > 0)
    {{-- le tableau --}}
@else
    <h3 class="text-success">
        Aucun livre n'a besoin d'être commandé pour l'instant !
    </h3>
@endif
```

Ou, plus court, avec `@forelse` — un `@foreach` doté d'un cas « collection vide » :

```blade
@forelse ($books as $book)
    <tr>
        <td>{{ $book->title }}</td>
        <td>{{ $book->pages }}</td>
        <td>{{ $book->quantity }}</td>
    </tr>
@empty
    <tr>
        <td colspan="3">Aucun livre n'a besoin d'être commandé pour l'instant !</td>
    </tr>
@endforelse
```

---

### TODO-8-0 — Modèle `Author` + migration

```bash
php artisan make:model Author --migration
```

> `--migration` peut s'écrire `-m`. La commande crée deux fichiers d'un coup :
> `app/Models/Author.php` et une migration `..._create_authors_table.php`.

---

### TODO-8-1 — Champ `name` dans la table `authors`

**Fichier :** la migration `database/migrations/..._create_authors_table.php`

```php
Schema::create('authors', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
```

Puis :

```bash
php artisan migrate
```

---

### TODO-8-2 — Clé étrangère `author_id` dans `books`

Créer une **nouvelle** migration (on ne modifie pas une migration déjà exécutée) :

```bash
php artisan make:migration add_author_fk_to_books --table=books
```

> Si le nom de la migration respecte les conventions Laravel (`..._to_books`),
> l'option `--table=books` est facultative.

**Fichier :** la migration `..._add_author_fk_to_books.php`

```php
public function up()
{
    Schema::table('books', function (Blueprint $table) {
        $table->foreignId('author_id')->nullable()->constrained()->cascadeOnDelete();
    });
}
```

> **Une seule de ces deux écritures**, elles sont équivalentes — ne pas mettre les deux,
> sinon la colonne est déclarée deux fois :
>
> ```php
> $table->foreignId('author_id')->nullable()->constrained()->cascadeOnDelete();
> $table->foreignId('author_id')->nullable()->constrained()->onDelete('cascade');
> ```
>
> Détail des méthodes :
>
> - `foreignId` crée une colonne `UNSIGNED BIGINT`, du même type que le `id()` de `authors` ;
> - `constrained` déduit la table cible du nom de la colonne (`author_id` → `authors`) ;
> - `nullable` autorise les livres sans auteur — indispensable, la table contient déjà des lignes ;
> - `cascadeOnDelete` supprime les livres d'un auteur supprimé.

---

### TODO-8-3 — Méthode `down`

**Fichier :** la même migration

```php
public function down()
{
    Schema::table('books', function (Blueprint $table) {
        $table->dropForeign(['author_id']);
        $table->dropColumn('author_id');
    });
}
```

> **L'ordre compte** : on retire d'abord la contrainte, ensuite la colonne. L'inverse échoue,
> la colonne étant encore référencée. Noter aussi le tableau dans `dropForeign(['author_id'])`.

---

### TODO-8-4 — Vérifier l'aller-retour

```bash
php artisan migrate:rollback
php artisan migrate
```

> `rollback` exécute le `down()` du dernier lot de migrations. Si les deux commandes passent
> sans erreur, la migration est réversible — c'est ce qu'on cherche à valider ici.

---

### TODO-8-5 — Relation entre les modèles

**Fichier :** `app/Models/Author.php`

```php
public function books()
{
    return $this->hasMany(Book::class);
}
```

**Fichier :** `app/Models/Book.php`

```php
public function author()
{
    return $this->belongsTo(Author::class);
}
```

> Côté `Book` la méthode est au **singulier** (un livre = un auteur), côté `Author` au **pluriel**
> (un auteur = plusieurs livres). La clé étrangère vit dans la table `books`, donc c'est `Book`
> qui porte le `belongsTo`.
>
> Ces méthodes s'utilisent ensuite comme des propriétés : `$book->author->name`, `$author->books`.

---

### TODO-8-6 — Autoriser `author_id` au _mass assignment_

**Fichier :** `app/Models/Book.php`

```php
protected $fillable = [
    'title', 'pages', 'quantity', 'author_id',
];
```

> Même mécanisme qu'au TODO-5-8 : un champ absent de `$fillable` est silencieusement ignoré
> par `create()` et `update()`. Oublier cette ligne est la cause n°1 du « l'auteur ne s'enregistre pas ».

---

### TODO-8-7 — Afficher l'ID de l'auteur

**Fichier :** `resources/views/books/index.blade.php`

```blade
<td>{{ $book->author_id ?? "Auteur inconnu..." }}</td>
```

> `??` est l'opérateur de coalescence : il renvoie la valeur de gauche si elle existe
> et n'est pas `null`, sinon celle de droite. Indispensable ici, puisque `author_id`
> est `nullable`.
>
> ```php
> $foo = $bar ?? 'something';
> $foo = isset($bar) ? $bar : 'something';   // équivalent, en plus long
> ```

---

### TODO-8-8 — Créer des auteurs avec tinker

Commencer par autoriser le _mass assignment_ sur `Author`, sinon `create()` refusera d'écrire
(même problème qu'au TODO-5-8). Dans `app/Models/Author.php` :

```php
protected $fillable = ['name'];
```

Puis lancer tinker — une console PHP interactive branchée sur l'application :

```bash
php artisan tinker
```

```php
// Créer les auteurs
$hobb    = App\Models\Author::create(['name' => 'Robin Hobb']);
$tolkien = App\Models\Author::create(['name' => 'J.R.R. Tolkien']);
$orwell  = App\Models\Author::create(['name' => 'George Orwell']);

// Attribuer aux 4 premiers livres, quels que soient leurs ID
$books = App\Models\Book::orderBy('id')->get();
$books[0]->update(['author_id' => $hobb->id]);
$books[1]->update(['author_id' => $hobb->id]);
$books[2]->update(['author_id' => $tolkien->id]);
$books[3]->update(['author_id' => $orwell->id]);

// Vérifier
App\Models\Book::with('author')->get();
$hobb->books;   // les 2 livres de Robin Hobb
```

Sortir de tinker avec `exit` ou Ctrl+D.

> Laisser au moins un livre sans auteur : c'est ce qui permet de tester le « Auteur inconnu... ».

---

### TODO-8-9 — Afficher le nom plutôt que l'ID

**Fichier :** `app/Http/Controllers/BookController.php`, méthode `index()`

```php
$books = \App\Models\Book::with('author')->latest()->paginate(5);
```

**Fichier :** `resources/views/books/index.blade.php`

```blade
<td>{{ $book->author->name ?? "Auteur inconnu..." }}</td>
```

> **Pourquoi `with('author')` ?** Sans lui, la page fonctionne quand même, mais Laravel exécute
> une requête SQL **par livre** pour aller chercher l'auteur (6 requêtes pour 5 livres) : c'est
> le problème **N+1**. `with('author')` charge tous les auteurs en une seule requête supplémentaire.
>
> Noter que le `??` protège maintenant deux choses : `author` peut être `null`, et on ne peut pas
> lire `->name` sur `null`.

---

### TODO-8-10 — Envoyer les auteurs au formulaire

**Fichier :** `app/Http/Controllers/BookController.php`

```php
public function create()
{
    $authors = \App\Models\Author::all();
    return view('books.create', compact('authors'));
}
```

> `compact('authors')` est un raccourci pour `['authors' => $authors]`.

---

### TODO-8-11 — Champ `select` dans le formulaire de création

**Fichier :** `resources/views/books/create.blade.php`

```blade
<div class="col-12 mb-3">
    <label for="authorSelect" class="form-label">Auteur</label>
    <select class="form-select" name="author_id" id="authorSelect">
        <option value="">Auteur inconnu...</option>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
        @endforeach
    </select>
</div>
```

> **L'attribut `name` doit valoir exactement `author_id`** : c'est lui, et pas le `id` HTML,
> qui donne son nom au champ envoyé au contrôleur. Un `name` différent et la valeur n'arrive
> jamais dans `$request`.
>
> La première `<option>` avec `value=""` permet de ne pas choisir d'auteur (la colonne est `nullable`).

---

### TODO-8-12 — Conserver les saisies en cas d'erreur

**Fichier :** `resources/views/books/create.blade.php`

Sur chaque champ texte :

```blade
<input type="text" name="title"    value="{{ old('title') }}"    class="form-control" id="inputTitle" />
<input type="text" name="pages"    value="{{ old('pages') }}"    class="form-control" id="inputPages" />
<input type="text" name="quantity" value="{{ old('quantity') }}" class="form-control" id="inputQuantity" />
```

Sur le `select`, il faut re-sélectionner la bonne option :

```blade
<div class="col-12 mb-3">
    <label for="authorSelect" class="form-label">Auteur</label>
    <select class="form-select" name="author_id" id="authorSelect">
        <option value="">Auteur inconnu...</option>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                {{ $author->name }}
            </option>
        @endforeach
    </select>
</div>
```

> `old('title')` relit la valeur envoyée à la **requête précédente**. Elle est disponible parce que
> la validation qui a échoué (TODO-6-0) renvoie automatiquement les saisies en session.
> Sans ces `old()`, l'utilisateur doit tout retaper à la moindre faute de frappe.

---

### TODO-8-13 — Valider le champ auteur

**Fichier :** `app/Http/Controllers/BookController.php`, dans le `validate()` de `store()`

```php
'author_id' => 'nullable|integer|exists:authors,id',
```

> `nullable` : le champ peut rester vide. `exists:authors,id` : si une valeur est fournie,
> elle doit correspondre à un auteur réel — sinon un utilisateur pourrait envoyer un ID au hasard.

---

### TODO-9-0 — Importer les icônes Bootstrap

**Fichier :** `resources/views/layout/app.blade.php`  
**Où :** dans le `<head>`, à côté du CSS Bootstrap.

```html
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
/>
```

Une fois importé, une icône s'utilise comme ceci :

```html
<i class="bi bi-arrow-right-circle"></i>
```

> Catalogue complet : https://icons.getbootstrap.com/

---

### TODO-9-1 — Ajouter des icônes dans l'app

Libre à toi. Quelques emplacements classiques :

```blade
{{-- boutons d'action de la liste --}}
<a class="btn btn-info"    href="..."><i class="bi bi-eye-fill"></i></a>
<a class="btn btn-primary" href="..."><i class="bi bi-pencil-fill"></i></a>
<button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>

{{-- bouton retour --}}
<a class="btn btn-outline-secondary" href="..."><i class="bi bi-arrow-left"></i> Retour</a>
```

> Si un bouton ne contient **qu'**une icône, ajouter un `title="Modifier"` ou un
> `aria-label="Modifier"` : sans texte, un lecteur d'écran n'annonce rien d'utile.
