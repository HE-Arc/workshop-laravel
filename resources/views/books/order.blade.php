@extends("layout.app")

@section("content")

<h1>Livre à commander</h1>
<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-primary" href="{{route("books.index")}}">Retour aux livres</a>
    </div>
</div>

@if ($books->count() > 0)
<table class="table">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Pages</th>
            <th scope="col">Quantité</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>{{$book->title}}</td>
            <td>{{$book->pages}}</td>
            <td>{{$book->quantity}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $books->links() !!}
@else
<h3 class="text-success">Aucun livre n'a besoin d'être commandés pour l'instant!</h3>
@endif

@endsection
