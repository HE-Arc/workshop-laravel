{{-- TODO-5-2, TODO-5-8 : formulaire de creation | TODO-6-2 : affichage des erreurs --}}
{{-- TODO-8-11 : select auteur | TODO-8-12 : conservation des saisies avec old() --}}
@extends("layout.app")

@section("content")

<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-outline-secondary" href="{{ route('books.index') }}"><i class="bi bi-arrow-left"></i> Retour</a>
    </div>
</div>

<form action="{{ route('books.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-12 col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header">Nouveau livre</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputTitle" class="form-label">Titre</label>
                            <input type="text" name="title" value="{{old('title')}}" class="form-control" id="inputTitle">
                        </div>
                        <div class="col-6">
                            <label for="inputPages" class="form-label">Nombre de pages</label>
                            <input type="text" name="pages" value="{{old('pages')}}" class="form-control" id="inputPages">
                        </div>
                        <div class="col-6">
                            <label for="inputQuantity" class="form-label">Quantité</label>
                            <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control" id="inputQuantity">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="authorSelect" class="form-label">Auteur</label>
                            <select class="form-select" name="author_id" id="authorSelect">
                                <option value="">Auteur inconnu...</option>
                                @foreach ($authors as $author)
                                <option value="{{$author->id}}" {{ (old("author_id") == $author->id ? "selected":"") }}>{{$author->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger mt-3 col-12">
                        <strong>Whoops!</strong> Il y a un probleme avec vos entrees.<br /><br />
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
