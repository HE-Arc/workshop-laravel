# Configuration du workshop

La documentation de configuration du workshop se trouve dans le README sur la branche `main`.

Ce README sera utile durant la réalisation du workshop.

# Réponses

**ATTENTION**  
Ce README a été conçu pour être visualisé en mode "preview", depuis GitHub ou depuis n'importe quel autre interpréteur MarkDown.  
Si vous ouvrez et suivez les instructions de ce fichier dans votre IDE, vous pourriez avoir quelques soucis avec le copier-coller, etc.

**AVERTISSEMENT**  
Lire les réponses uniquement en cas de besoins, essayez d'abords par vous-même, vous apprendrez mieux ;)

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
Route::get('/', [HomeController::class, 'index']);
```

TODO-1-3

- Créer la vue blade `home.blade.php`
- Ecrire "Hello world!" sur la vue
- Modifier le controleur pour renvoyer la vue

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
Book::truncate();

$books = [
    ['title' => 'Hunter x Hunter n°1', 'pages' => 110, 'quantity' => 1],
    ['title' => 'Hunter x Hunter n°2', 'pages' => 87, 'quantity' => 10],
    ['title' => 'Harry and the Poter', 'pages' => 123, 'quantity' => 11],
    ['title' => 'Youpi Lands', 'pages' => 9, 'quantity' => 0]
];

foreach ($books as $book){
    Book::create(array(
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
$books = Book::all();
return view('books', ['books' => $books]);
```

TODO-4-2

```php
Route::resource('books', BookController::class);
```

TODO-4-3

TODO-4-4

```php
<div class="container mt-3">
    @yield('content')
</div>
```

TODO-4-5

```php
@extends('layout.app')

@section('content')
<h1>Library App</h1>
<p class="lead">Hello World</p>
@endsection
```

TODO-4-6

```php
@extends('layout.app')

@section('content')
    @foreach ($books as $book)
    {{$book}}
    @endforeach
@endsection
```

TODO-4-7

TODO-5-0
