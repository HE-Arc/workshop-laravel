{{-- TODO-5-2, TODO-5-10 : details d un livre --}}
@extends("layout.app")

@section("content")

<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-outline-secondary" href="{{ route('books.index') }}"><i class="bi bi-arrow-left"></i> Retour</a>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6 offset-lg-3">
        <div class="card">
            <div class="card-header">Afficher un livre</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12"><strong>Titre :</strong> {{ $book->title }}</div>
                    <div class="col-6"><strong>Nombre de pages :</strong> {{ $book->pages }}</div>
                    <div class="col-6"><strong>Quantité :</strong> {{ $book->quantity }}</div>
                    <div class="col-12"><strong>Auteur :</strong> {{ $book->author->name ?? "Auteur inconnu..." }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
