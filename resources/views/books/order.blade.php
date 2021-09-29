@extends('layout.app')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-primary" href="{{ route('books.index') }}"> Retour</a>
    </div>
</div>

<h2>Livres à commander</h2>
<p>Liste des livres à commander, si la quantité est inférieure ou égale à 0.</p>

@if($books->count() > 0)
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
<h3 class="text-success">Aucun livre n'a besoin d'être commandé pour l'instant!</h3>
@endif

@endsection
