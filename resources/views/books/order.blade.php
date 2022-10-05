@extends("layout.app")

@section("content")

<h1>Order</h1>

<a href="{{route("books.index")}}" class="btn btn-primary mb-2">Retour aux livres</a>

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
<h3 class="text-success">Aucun livre n'a besoin d'être commandé pour l'instant !</h3>
@endif


@endsection
