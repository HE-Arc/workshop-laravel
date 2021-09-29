@extends('layout.app')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-primary" href="{{ route('books.index') }}"> Retour</a>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6 offset-0 offset-lg-3">
        <div class="card">
            <div class="card-header">
                Afficher un livre
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-12">
                        <strong>Titre :</strong>
                        {{ $book->title }}
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-6">
                            <strong>Nombre de pages :</strong>
                            {{ $book->pages }}
                        </div>
                        <div class="form-group col-6">
                            <strong>Quantité :</strong>
                            {{ $book->quantity }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
