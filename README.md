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

```html
<div class="container mt-3">
    @yield('content')
</div>
```

TODO-4-5

```html
@extends('layout.app')

@section('content')
<h1>Library App</h1>
<p class="lead">Hello World</p>
@endsection
```

TODO-4-6

```html
@extends('layout.app')

@section('content')
    @foreach ($books as $book)
    {{$book}}
    @endforeach
@endsection
```

TODO-4-7

```html
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
        <td>{{$book->title}}</td>
        <td>{{$book->pages}}</td>
        <td>{{$book->quantity}}</td>
        <td>
            <a class="btn btn-info" href="{{ route('books.show',$book->id) }}"><i class="bi bi-arrow-right-circle"></i></a>
            <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}"><i class="bi bi-pencil"></i></a>
            <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
```

TODO-5-0

TODO-5-1

Mettre `view('books.index'...` dans le controller

TODO-5-2

Créer les vues manquantes `show.blade.php`, `create.blade.php` et `edit.blade.php` et inscrire quelque chose de temporaire sur chaque vue

TODO-5-3

Relier les méthode `create`, `show` et `edit` du controleur aux vues correspondantes
```php
public function create()
{
    return view('books.create');
}

public function show($id)
{
    return view('books.show');
}

public function edit($id)
{
    return view('books.edit');
}
```

TODO-5-4

```html
<!--ajouter un livre-->
<a href="{{ route('books.create') }}" class="btn btn-primary float-right mb-2">Ajouter un livre</a>

<!--actions-->
<td>
    <a class="btn btn-info" href="{{ route('books.show',$book->id) }}">Afficher</a>
    <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Modifier</a>
    <form action="{{ route('books.destroy',$book->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</td>
```

TODO-5-5

```php
public function store(Request $request)
{
    Book::create($request->all());

    return redirect()->route('books.index');
}

public function show($id)
{
    $book = Book::findOrFail($id);
    return view('books.show', ['book' => $book]);
}

public function edit($id)
{
    $book = Book::where('id', $id)->firstOrFail();
    return view('books.edit', ['book' => $book]);
}

public function update(Request $request, $id)
{
    Book::findOrFail($id)->update($request->all());

    return redirect()->route('books.index');
}

public function destroy($id)
{
    $book = Book::find($id);
    $book->delete();

    return redirect()->route('books.index');
}
```

TODO-5-6


```php
public function store(Request $request)
{
    Book::create($request->all());

    return redirect()->route('books.index')
        ->with('success','Book created successfully.');
}

public function show($id)
{
    $book = Book::findOrFail($id);
    return view('books.show', ['book' => $book]);
}

public function edit($id)
{
    $book = Book::where('id', $id)->firstOrFail();
    return view('books.edit', ['book' => $book]);
}

public function update(Request $request, $id)
{
    Book::findOrFail($id)->update($request->all());

    return redirect()->route('books.index')
        ->with('success','Book updated successfully');
}

public function destroy($id)
{
    $book = Book::find($id);
    $book->delete();

    return redirect()->route('books.index')
                    ->with('success','Book deleted successfully');
}
```

> Il est également possible de mettre le type de l'élément attendu dans les paramètres afin que Laravel fasse de lui même la conversion
> ```php
> public function show(Book $book)
> {
>     return view('books.show', compact('book'));
> }
> ```

TODO-5-7

```html
<div class="container mt-3">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @yield('content')
</div>
```

TODO-5-8

```html
@extends('layout.app')

@section('content')

{{ route('books.index') }}

{{ route('books.store') }}
@csrf

@endsection
```

Résoudre le problème du "mass assignement"

> Le fait d'utiliser `$request->all()` pose problème, un user malvaillant pourrait modifier des champs sensibles, car pas de control précis parce qu'on modifie tous les champs en même temps sans regarder quoi. Il y a 2 solutions, les voici :

1. Remplacer `Book::create($request->all());` dans `BookControler.store` par
```php
$book = new Book();
$book->title = $request->title;
$book->pages = $request->pages;
$book->quantity = $request->quantity;
$book->save();
```

2. Remettre le `Book::create()` et ajouter `$fillable` dans le modèle Book ce qui suit
```php
protected $fillable = [
    'title', 'pages', 'quantity'
];
```

> Il existe aussi une autre méthode que fillable, qui fait l'inverse (permet d'indiquer les champs qui ne peuvent pas être mass assignable), mais non recommandée. Le mieux c'est de mettre les champs fillable dans le modèle et en fonction des besoins faire un request->all() ou de préciser les champs du modèle à modifier.

TODO-5-9

```html
@extends('layout.app')

@section('content')

{{ route('books.index') }}

{{ route('books.update', $book->id) }}

@csrf
@method('PUT')

{{ $book->title }}
{{ $book->pages }}
{{ $book->quantity }}

@endsection
```

TODO-5-10

```html
@extends('layout.app')

@section('content')
{{ route('books.index') }}

{{ $book->title }}
{{ $book->pages }}
{{ $book->quantity }}

@endsection
```

TODO-6-0

```php
$request->validate([
   'title' => 'required|min:5|max:25',
   'pages' => 'required|integer|gt:0|lt:1000',
   'quantity' => 'required|integer|gte:0|lt:100',
]);
```
> Le validateur va automatiquement créer et retourner un tableau d'erreurs

TODO-6-1

```html
{{ $errors }}
```

TODO-6-2

```html
@if ($errors->any())
    <div class="alert alert-danger mt-3 col-12">
        <strong>Whoops!</strong> Il y a un problème avec vos entrées.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

TODO-6-3

```php
$books = Book::latest()->paginate(5);
return view('books.index', compact('books'))
    ->with('i', (request()->input('page', 1) - 1) * 5);
```

TODO-6-4

Placer après `</table>`

```html
{!! $books->links() !!}
```

TODO-6-5

Le CSS généré pour les liens de paginations est généré pour fonctionner avec Tailwind CSS. Nous utilisons Bootstrap et Laravel à pensé à nous. Il suffit de rajouter ce qui suit dans `App\Providers\AppServiceProvider`
```php
use Illuminate\Pagination\Paginator;

public function boot()
{
    Paginator::useBootstrap();
}
```

TODO-7-0

```html
@extends('layout.app')

@section('content')
{{ route('books.index') }}

@endsection
```

TODO-7-1

> Attention : Il faut mettre la route get avant la ressource, sinon le routeur ne la trouvera pas !

```php
Route::get('books/order', [BookController::class, 'order'])->name('books.order');
```

TODO-7-2

```php
public function order()
{
    $books = Book::latest()->where('quantity', '<=', 0)->paginate(5);

    return view('books.order', compact('books'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
}
```

TODO-7-3

```html
<li class="nav-item">
    <a class="nav-link" href="{{ route('books.order') }}">To Order</a>
</li>
```

TODO-7-4

```html
@if ($books->count() > 0)
@else
<h3 class="text-success">Aucun livre n'a besoin d'être commandés pour l'instant!</h3>
@endif
```

https://hackmd.io/sNwLjBX1Qx6KQA20YLn0uw?both#Relation

TODO-8-0

- `php artisan make:model Author --migration`
> `--migration` peut être remplacé par `-m`

TODO-8-1

```php
Schema::create('authors', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
```

TODO-8-2

`php artisan make:migration add_author_fk_to_books --table=books`
