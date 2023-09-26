<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$book = new Book($request->all());
        //$book->save();

        $request->validate([
            'title' => 'required|min:5|max:25',
            'pages' => 'required|integer|gt:0|lt:1000',
            'quantity' => 'required|integer|gte:0|lt:100'
        ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'book created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        Book::findOrFail($id)->update($request->all());
        return redirect()->route('books.index')->with('success', 'book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->route('books.index')->with('success', 'book destroyed successfully');
    }
}
