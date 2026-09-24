<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    // TODO-4-1 / TODO-6-3 / TODO-8-9
    public function index()
    {
        $books = \App\Models\Book::with('author')->latest()->paginate(5);

        /*return view('books.index', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);*/
        return view('books', ['books' => $books]); // pour le todo 4
    }

    // TODO-7-2
    public function order()
    {
        $books = \App\Models\Book::latest()->where('quantity', '<=', 0)->paginate(5);

        return view('books.order', compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // TODO-5-3 / TODO-8-10
    public function create()
    {
        $authors = \App\Models\Author::all();
        return view('books.create', compact('authors'));
    }

    // TODO-5-5 / TODO-5-6 / TODO-6-0 / TODO-8-13
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:6|max:25',
            'pages' => 'required|integer|gt:0|lt:1000',
            'quantity' => 'required|integer|gte:0|lt:100',
            'author_id' => 'nullable|integer|exists:authors,id'
        ]);

        \App\Models\Book::create($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    // TODO-5-5
    public function show(string $id)
    {
        $book = \App\Models\Book::findOrFail($id);
        return view('books.show', ['book' => $book]);
    }

    // TODO-5-5
    public function edit(string $id)
    {
        $book = \App\Models\Book::where('id', $id)->firstOrFail();
        return view('books.edit', ['book' => $book]);
    }

    // TODO-5-5 / TODO-5-6
    public function update(Request $request, string $id)
    {
        \App\Models\Book::findOrFail($id)->update($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully');
    }

    // TODO-5-5 / TODO-5-6
    public function destroy(string $id)
    {
        $book = \App\Models\Book::find($id);
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');
    }
}
