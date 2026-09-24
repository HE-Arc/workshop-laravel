{{-- TODO-7-0 : livres a commander | TODO-7-4 : message si la liste est vide --}}
@extends("layout.app")

@section("content")

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Livres à commander</h1>
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Retour aux livres</a>
</div>

<table class="table table-hover align-middle">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Pages</th>
            <th scope="col">Quantité</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->pages }}</td>
            <td>{{ $book->quantity }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-success">Aucun livre a besoin d etre commande pour l instant!</td>
        </tr>
        @endforelse
    </tbody>
</table>

{!! $books->links() !!}
@endsection
