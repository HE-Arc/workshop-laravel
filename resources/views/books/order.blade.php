@extends('layout.app')
@section('content')
    <h1>Commandes</h1>

    <a href="{{route('books.create')}}" class="btn btn-primary float-right mb-2">Ajouter un livre</a>

    @if($books->count() <= 0)
        <h3 class="text-success">Aucun livre n'a besoin d'être commandés pour l'instant!</h3>
    @else
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
                @foreach($books as $book)
                    <tr>
                        <td>{{$book->title}}</td>
                        <td>{{$book->pages}}</td>
                        <td>{{$book->quantity}}</td>
                        <td>
                            <a class="btn btn-info" href="{{route('books.show', $book->id)}}">Afficher</a>
                            <a class="btn btn-primary" href="{{route('books.edit', $book->id)}}">Modifier</a>
                            <form action="{{route('books.destroy', $book->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

    @endif

    {!! $books->links() !!}
@endsection
