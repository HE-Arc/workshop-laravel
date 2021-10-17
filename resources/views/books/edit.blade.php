@extends('layout.app')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-primary" href="{{ route('books.index') }}"> Retour</a>
    </div>
</div>

<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-12 col-lg-6 offset-0 offset-lg-3">
            <div class="card">
                <div class="card-header">
                    Modifier un livre
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                        <label for="inputTitle">Titre</label>
                        <input type="text" name="title" value="{{ $book->title }}" class="form-control" id="inputTitle">
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-6">
                            <label for="inputPages">Nombre de pages</label>
                            <input type="text" name="pages" value="{{ $book->pages }}" class="form-control" id="inputPages">
                            </div>
                            <div class="form-group col-6">
                            <label for="inputQuantity">Quantité</label>
                            <input type="text" name="quantity" value="{{ $book->quantity }}" class="form-control" id="inputQuantity">
                            </div>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger mt-3 col-12">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
