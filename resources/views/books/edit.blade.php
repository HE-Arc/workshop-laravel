{{-- TODO-5-2, TODO-5-9 : formulaire d edition (@method PUT) --}}
@extends("layout.app")

@section("content")

<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-outline-secondary" href="{{ route('books.index') }}"><i class="bi bi-arrow-left"></i> Retour</a>
    </div>
</div>

<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-12 col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header">Modifier un livre</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputTitle" class="form-label">Titre</label>
                            <input type="text" name="title" value="{{ $book->title }}" class="form-control" id="inputTitle">
                        </div>
                        <div class="col-6">
                            <label for="inputPages" class="form-label">Nombre de pages</label>
                            <input type="text" name="pages" value="{{ $book->pages }}" class="form-control" id="inputPages">
                        </div>
                        <div class="col-6">
                            <label for="inputQuantity" class="form-label">Quantité</label>
                            <input type="text" name="quantity" value="{{ $book->quantity }}" class="form-control" id="inputQuantity">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
