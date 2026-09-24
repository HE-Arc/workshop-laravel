{{-- TODO-4-7, TODO-4-8 : liste des livres | TODO-5-1 : renommee en index --}}
{{-- TODO-5-4 : boutons d actions | TODO-6-4 : liens de pagination --}}
{{-- TODO-8-7, TODO-8-9 : colonne auteur | TODO-9-1 : icones --}}
@extends("layout.app")

@section("content")

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Livres</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Ajouter un livre</a>
</div>

<table class="table table-hover align-middle">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Pages</th>
            <th scope="col">Quantité</th>
            <th scope="col">Auteur</th>
            <th scope="col" class="text-end">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>{{$book->title}}</td>
            <td>{{$book->pages}}</td>
            <td>{{$book->quantity}}</td>
            <td>{{$book->author->name ?? "Auteur inconnu..."}}</td>
            <td>
                <div class="d-flex gap-1 justify-content-end">
                    <a class="btn btn-info" href="{{ route('books.show',$book->id) }}"><i class="bi bi-eye-fill"></i></a>
                    <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}"><i class="bi bi-pencil-fill"></i></a>
                    <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $books->links() !!}
@endsection
